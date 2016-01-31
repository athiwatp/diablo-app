<div class="row">
    <div class="col-md-6">
        <!-- Name Form Input -->
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" value="{{ $users->name or '' }}">
        </div>
    </div>
    <div class="col-md-6">
        <!-- Email Form Input -->
        <div class="form-group">
            <label for="name">Email:</label>
            <input type="text" class="form-control" name="email" value="{{ $users->email or '' }}">
        </div>
    </div>
</div>