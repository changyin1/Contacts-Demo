<!-- Modal -->
<div class="modal fade" id="newContactModal" tabindex="-1" role="dialog" aria-labelledby="newContactModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Contact</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="create-contact-form" class="modal-form ajax" action="{{route('createContact')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="errors"></div>
                    <div class="form-body">
                        <div class="form-group">
                            <input name="first_name" id="first_name" class="form-control" type="text" required>
                            <label class="control-label" for="first_name">First Name</label>
                        </div>
                        <div class="form-group">
                            <input name="last_name" id="last_name" class="form-control" type="text" required>
                            <label class="control-label" for="last_name">Last Name</label>
                        </div>
                        <div class="form-group">
                            <input name="email" id="email" class="form-control" type="text" required>
                            <label class="control-label" for="email">Email</label>
                        </div>
                        <div class="form-group">
                            <input name="phone" id="phone" class="form-control" type="text">
                            <label class="control-label" for="phone">Phone</label>
                        </div>
                        <div class="form-group">
                            <input name="birthday" id="birthday" class="form-control" type="text">
                            <label class="control-label" for="birthday">Birthday</label>
                        </div>
                        <div class="form-group">
                            <input name="city" id="address" class="form-control" value="{{$contact->address}}" type="text">
                            <label class="control-label" for="address">Address</label>
                        </div>
                        <div class="form-group">
                            <input name="city" id="city" class="form-control" type="text">
                            <label class="control-label" for="city">City</label>
                        </div>
                        <div class="form-group">
                            <input name="state" id="state" class="form-control" type="text">
                            <label class="control-label" for="state">State</label>
                        </div>
                        <div class="form-group">
                            <input name="zip" id="zip" class="form-control" type="text">
                            <label class="control-label" for="email">Zip</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn btn-primary btn-submit">
                </div>
            </form>
        </div>
    </div>
</div>