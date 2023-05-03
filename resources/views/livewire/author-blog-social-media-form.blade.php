<div>
    <form method="post" wire:submit.prevent='updateBlogSocialMedia()'>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="">Facebook</label>
                    <input type="text" class="form-control" placeholder="Facebook page URL" wire:model='facebook_url'>
                    <span class="text-danger">@error('facebook_url'){{ $message }}@enderror</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="">Instagram</label>
                    <input type="text" class="form-control" placeholder="Instagram page URL" wire:model='instagram_url'>
                    <span class="text-danger">@error('instagram_url'){{ $message }}@enderror</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="">Youtube</label>
                    <input type="text" class="form-control" placeholder="Youtube page URL" wire:model='youtube_url'>
                    <span class="text-danger">@error('youtube_url'){{ $message }}@enderror</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label" for="">Linkedin</label>
                    <input type="text" class="form-control" placeholder="Linkedin page URL" wire:model='linkedin_url'>
                    <span class="text-danger">@error('linkedin_url'){{ $message }}@enderror</span>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
