<?php

namespace App\Actions\Team;

use App\Models\TeamMember;
use Illuminate\Support\Facades\Storage;

class DeleteAction
{
	public function execute(TeamMember $member): void
	{
		if ($member->media) {
			Storage::disk('public')->delete($member->media);
		}

		$member->delete();
	}
}
