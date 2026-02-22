<?php

namespace App\Http\Controllers\Api;

use App\Actions\Team\DeleteAction as DeleteTeamAction;
use App\Actions\Team\StoreAction as StoreTeamAction;
use App\Actions\Team\UpdateAction as UpdateTeamAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Team\StoreTeamRequest;
use App\Http\Requests\Team\UpdateTeamRequest;
use App\Http\Resources\TeamMemberResource;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
{
	public function index()
	{
		$members = TeamMember::orderBy('order')->get();

		return TeamMemberResource::collection($members);
	}

	public function store(StoreTeamRequest $request)
	{
		$member = (new StoreTeamAction)->execute($request->validated());

		return new TeamMemberResource($member);
	}

	public function show(TeamMember $team)
	{
		return new TeamMemberResource($team);
	}

	public function update(UpdateTeamRequest $request, TeamMember $team)
	{
		$member = (new UpdateTeamAction)->execute($team, $request->validated());

		return new TeamMemberResource($member);
	}

	public function toggle(TeamMember $team)
	{
		$team->update(['publish' => !$team->publish]);

		return new TeamMemberResource($team);
	}

	public function destroy(TeamMember $team)
	{
		(new DeleteTeamAction)->execute($team);

		return response()->json(null, 204);
	}

	public function reorder(Request $request)
	{
		foreach ($request->items as $item) {
			TeamMember::find($item['id'])->update(['order' => $item['order']]);
		}

		return response()->json(['message' => 'Reordered']);
	}

	public function unlink(TeamMember $team)
	{
		if ($team->media) {
			Storage::disk('public')->delete($team->media);
			$team->update(['media' => null]);
		}

		return new TeamMemberResource($team);
	}
}
