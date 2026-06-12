


<form action="/farms" method="POST">
    @csrf
    <div class="form-group">
        <label for="farm_name">Farm Name</label>
        <input type="text" class="form-control" id="farm_name" name="farm_name" required>
    </div>
    <div class="form-group">
        <label for="farmer_id">Farmer</label>
        <select class="form-control" id="farmer_id" name="farmer_id" required>
            <!-- Populate this select with options from the farmers table -->
        </select>
    </div>
    <div class="form-group">
        <label for="postal_address">Postal Address</label>
        <input type="text" class="form-control" id="postal_address" name="postal_address" required>
    </div>
    <div class="form-group">
        <label for="contact_phone">Contact Phone</label>
        <input type="text" class="form-control" id="contact_phone" name="contact_phone" required>
    </div>
    <div class="form-group">
        <label for="size">Farm Size</label>
        <input type="text" class="form-control" id="size" name="size" required>
    </div>
    <div class="form-group">
        <label for="lat">Latitude</label>
        <input type="text" class="form-control" id="lat" name="lat" required>
    </div>
    <div class="form-group">
        <label for="long">Longitude</label>
        <input type="text" class="form-control" id="long" name="long" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Farm</button>
</form>


<form action="/plots" method="POST">
    @csrf
    <div class="form-group">
        <label for="farm_id">Farm</label>
        <select class="form-control" id="farm_id" name="farm_id" required>
            <!-- Populate this select with options from the farms table -->
        </select>
    </div>
    <div class="form-group">
        <label for="name">Plot Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="size">Plot Size</label>
        <input type="text" class="form-control" id="size" name="size" required>
    </div>
    <div class="form-group">
        <label for="lat">Latitude</label>
        <input type="text" class="form-control" id="lat" name="lat" required>
    </div>
    <div class="form-group">
        <label for="long">Longitude</label>
        <input type="text" class="form-control" id="long" name="long" required>
    </div>
    <button type="submit" class="btn btn-primary">Add Plot</button>
</form>


<form action="/recommendations" method="POST">
    @csrf
    <div class="form-group">
        <label for="request_id">Farmer Request</label>
        <select class="form-control" id="request_id" name="request_id" required>
            <!-- Populate this select with options from the farmer_requests table -->
        </select>
    </div>
    <div class="form-group">
        <label for="partner_id">Partner</label>
        <select class="form-control" id="partner_id" name="partner_id" required>
            <!-- Populate this select with options from the partners table -->
        </select>
    </div>
    <div class="form-group">
        <label for="file_path">File Path</label>
        <input type="text" class="form-control" id="file_path" name="file_path" required>
    </div>
    <div class="form-group">
        <label for="notes">Recommendation Notes</label>
        <textarea class="form-control" id="notes" name="notes" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Recommendation</button>
</form>
