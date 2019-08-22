<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="asterisk-required">Position</label>
            <input class="form-control" placeholder="Position" name="position_name" value="{{@$employee->position_name}}" required>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="asterisk-required">Account</label>
             <select class="select2 form-control" name="account_id" required>
                <option selected="" disabled="">Select</option>
                @foreach($accounts as $account)
                    <option <?php echo @$employee->account_id == $account->id ? "selected" : "" ; ?> value="{{$account->id}}">{{$account->account_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label>Team/Department</label>
            <select class="select2 form-control" name="team_name">
                <option selected="" disabled="">Select</option>
                @foreach($departments as $department)
                    <option <?php echo $department->department_name == @$employee->team_name ? "selected" : "";?> value="{{ $department->department_name }}"> {{$department->department_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
<div class="row">
<div class="col-md-3">
    <div class="form-group">
        <label>Manager</label>
       <select class="select2 form-control" name="manager_id">
            <option selected="" disabled="">Select</option>
           @foreach($supervisors as $supervisor)
                <option value="{{ $supervisor->id }}" <?php echo $supervisor->fullname() == @$employee->manager_name || $supervisor->id == @$employee->manager_id ? "selected" : "" ; ?>> {{$supervisor->fullname()}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label>Supervisor</label>
        <select class="select2 form-control"  name="supervisor_id" >
            <option selected="" disabled="">Select</option>
            @foreach($supervisors as $supervisor)
            <option value="{{ $supervisor->id }}" <?php echo $supervisor->fullname() == @$employee->supervisor_name || $supervisor->id == @$employee->supervisor_id ? "selected" : "" ; ?>> {{$supervisor->fullname()}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label>Hire Date</label>
        <input class="form-control datepicker" placeholder="Hire Date" name="hired_date" value="{{@$employee->datehired()}}">
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label>Production Date</label>
        <input class="form-control datepicker" placeholder="Hire Date" name="prod_date" value="{{@$employee->prodDate()}}">
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
        <label class="asterisk-required">Employee Status</label>
         <select class="select2 form-control" name="status_id" required>
            <option selected="" disabled="">Select</option>
            <option <?php echo @$employee->status == 1 ? "selected" : "" ; ?> value="1">Active</option>
            <option <?php echo @$employee->status == 2 ? "selected" : "" ; ?> value="2">Inactive</option>
        </select>
    </div>
</div>
<div class="col-md-2">
    <div class="form-group">
        <label >EXT</label>
        <input class="form-control" placeholder="Ext" name="ext" value="{{@$employee->ext}}" >
    </div>
</div>
<div class="col-md-2">
    <div class="form-group">
        <label >Wave </label>
        <input class="form-control" placeholder="Wave" name="wave" value="{{@$employee->wave}}" >
    </div>
</div>
<div class="col-md-12">
    <div class="form-group">
        <input type="checkbox" name="all_access" <?php echo @$employee->all_access == 1 ? "checked" : "" ; ?>> &nbsp;
        <span for="all_access">can view information from other account ?</span>
    </div>
</div>
</div>