<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Media;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeedPosts extends Command
{
	protected $signature = 'app:posts';

	protected $description = 'Create random posts with dummy images';

	protected array $titles = [
		'Neubau Wohnüberbauung Seefeld',
		'Sanierung Schulhaus Langwiesen',
		'Wettbewerb Stadtpark Süd',
		'Erweiterung Kulturzentrum Rote Fabrik',
		'Holzbau-Projekt Waldquartier',
		'Bürogebäude am Limmatquai',
		'Dachaufstockung Genossenschaft Zurlinden',
		'Masterplan Industriebrache Nord',
		'Umnutzung Lagerhalle Binz',
		'Wohnturm Hardbrücke',
		'Kindergarten Witikon',
		'Alterszentrum Grünau',
	];

	protected array $paragraphs = [
		'Das Projekt entstand aus einem offenen Wettbewerb und überzeugte die Jury durch seine klare städtebauliche Setzung. Die drei versetzten Baukörper schaffen differenzierte Aussenräume und ermöglichen vielfältige Blickbezüge zur umgebenden Landschaft.',
		'Die Materialisierung orientiert sich an der bestehenden Bebauungsstruktur. Sichtbeton, Holz und grossformatige Glasflächen prägen die Erscheinung. Besonderes Augenmerk wurde auf die Übergänge zwischen Innen- und Aussenraum gelegt.',
		'Im Erdgeschoss befinden sich gemeinschaftliche Nutzungen, die das Quartier beleben. Ein Café, Gemeinschaftsräume und eine Werkstatt stehen sowohl den Bewohnern als auch der Nachbarschaft offen.',
		'Die Tragstruktur basiert auf einem modularen Holzbausystem, das eine flexible Grundrissgestaltung ermöglicht. Die vorgefertigten Elemente wurden innerhalb weniger Wochen montiert, was die Bauzeit erheblich verkürzte.',
		'Nachhaltigkeit war von Beginn an ein zentraler Entwurfsparameter. Photovoltaik auf dem Dach, eine Erdsonden-Wärmepumpe und ein ausgeklügeltes Lüftungskonzept sorgen für einen minimalen Energieverbrauch.',
		'Die Freiraumgestaltung folgt dem Prinzip der Biodiversität. Einheimische Pflanzenarten, Versickerungsflächen und naturnahe Spielbereiche schaffen einen ökologisch wertvollen Aussenraum.',
		'Der Bestand wurde sorgfältig analysiert und die erhaltenswerten Elemente in das neue Konzept integriert. Die historische Fassade blieb weitgehend erhalten, während das Innere komplett neu organisiert wurde.',
		'Das Farbkonzept arbeitet mit gedeckten, erdigen Tönen, die eine warme Atmosphäre schaffen. Akzente in Messing und geölter Eiche setzen zurückhaltende Highlights in den öffentlichen Bereichen.',
	];

	public function handle(): void
	{
		$count = $this->ask('How many posts?', 8);
		$dummyImages = glob(storage_path('app/public/dummy/*.jpg'));

		if (empty($dummyImages)) {
			$this->error('No dummy images found in storage/app/public/dummy/');
			return;
		}

		$titles = collect($this->titles)->shuffle()->take($count);

		foreach ($titles as $title) {
			$numParagraphs = rand(2, 4);
			$content = collect($this->paragraphs)
				->shuffle()
				->take($numParagraphs)
				->map(fn ($p) => "<p>{$p}</p>")
				->implode('');

			$post = Post::create([
				'title' => $title,
				'slug' => Str::slug($title),
				'content' => $content,
				'publish' => (bool) rand(0, 1),
			]);

			$numImages = rand(3, 5);
			$images = collect($dummyImages)->shuffle()->take($numImages);

			foreach ($images->values() as $index => $imagePath) {
				$originalName = basename($imagePath);
				$name = pathinfo($originalName, PATHINFO_FILENAME);
				$ext = pathinfo($originalName, PATHINFO_EXTENSION);
				$uniqueName = $name . '-' . Str::random(6) . '.' . $ext;

				Storage::disk('public')->copy("dummy/{$originalName}", "uploads/{$uniqueName}");

				[$width, $height] = @getimagesize($imagePath) ?: [null, null];

				Media::create([
					'uuid' => Str::uuid(),
					'mediable_type' => Post::class,
					'mediable_id' => $post->id,
					'file' => $uniqueName,
					'original_name' => $originalName,
					'mime_type' => 'image/jpeg',
					'size' => filesize($imagePath),
					'width' => $width,
					'height' => $height,
					'is_teaser' => $index === 0,
					'sort_order' => $index,
				]);
			}

			$this->info("Created: {$title} ({$numImages} images)");
		}

		$this->info("Done! {$count} posts created.");
	}
}
