<section class="panel ownership-panel" aria-labelledby="ownership-heading">
    <div class="panel-header">
        <h2 id="ownership-heading">Ownership Change</h2>
        <p>Transfer Main Administrator access to another existing administrator.</p>
    </div>

    @php
        $currentOwner = $admins->first(fn ($admin) => strtolower(trim($admin->email)) === strtolower(trim($ownerAdminEmail)));
        $eligibleOwners = $admins->reject(fn ($admin) => $admin->id === auth()->id());
    @endphp

    <p class="ownership-current">
        Current owner:
        <strong>{{ $currentOwner ? $currentOwner->name.' ('.$currentOwner->email.')' : 'Not configured' }}</strong>
    </p>

    @if($currentUserIsOwner && $eligibleOwners->isNotEmpty())
        <form method="POST" action="{{ route('admin.admins.ownership.transfer') }}">
            @csrf
            <div class="form-group">
                <label for="new-owner">New Owner</label>
                <select id="new-owner" name="new_owner_id" required>
                    <option value="">Select an administrator</option>
                    @foreach($eligibleOwners as $candidate)
                        <option value="{{ $candidate->id }}" @selected((string) old('new_owner_id') === (string) $candidate->id)>
                            {{ $candidate->name }} — {{ $candidate->email }}
                        </option>
                    @endforeach
                </select>
                @error('new_owner_id', 'ownership') <p class="ownership-error">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label for="ownership-password">Your Current Password</label>
                <input id="ownership-password" name="ownership_password" type="password" autocomplete="current-password" required>
                @error('ownership_password', 'ownership') <p class="ownership-error">{{ $message }}</p> @enderror
            </div>

            <label class="ownership-confirm" for="confirm-ownership">
                <input id="confirm-ownership" type="checkbox" name="confirm_ownership" value="1" required>
                <span>I understand that the selected administrator will become the owner and my account will become a regular administrator.</span>
            </label>
            @error('confirm_ownership', 'ownership') <p class="ownership-error">{{ $message }}</p> @enderror

            <button type="submit" class="btn btn-primary">Transfer Ownership</button>
        </form>
    @elseif($currentUserIsOwner)
        <p class="security-note">Create another administrator first to transfer ownership.</p>
    @else
        <p class="security-note">Only the current Main Administrator can transfer ownership.</p>
    @endif
</section>
