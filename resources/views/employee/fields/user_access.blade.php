<div id="u_access-div" class="col-md-12">
    <div class="form-group">
        <input type="radio" {{ $employee->usertype == 1 ? 'checked' : ''}} id="employee" name="employee_type" value="1" placeholder="test">
        <label class="radio-label" for="employee">Employee</label>
        &nbsp;
        &nbsp;
        <input type="radio" {{ $employee->usertype == 2 ? 'checked' : ''}} id="supervisor" name="employee_type" value="2" placeholder="test">
        <label class="radio-label" for="supervisor">Supervisor</label>
        &nbsp;
        &nbsp;
        <input type="radio" {{ $employee->usertype == 3 ? 'checked' : ''}} id="manager" name="employee_type" value="3" placeholder="test">
        <label class="radio-label" for="manager">Manager</label>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        |
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        <input type="checkbox" {{ $employee->is_admin == 1 ? 'checked' : ''}} id="admin" name="is_admin">
    
        <label class="radio-label" for="admin">WebsiteAdmin</label>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        <input type="checkbox" {{ $employee->is_hr == 1 ? 'checked' : ''}} id="hr" name="is_hr">
    
        <label class="radio-label" for="hr">HR</label>
        &nbsp;
        &nbsp;
        &nbsp;
        &nbsp;
        <input type="checkbox" {{ $employee->is_erp == 1 ? 'checked' : ''}} id="erp" name="is_erp">
    
        <label class="radio-label" for="erp">ERP</label>
        &nbsp;
        &nbsp;
        <select name="is_regular" class="select2 is_reg_event">
            <option value="-1">Employee Type</option>
            <option value="0" {{ $employee->is_regular == 0 ? 'selected' : ''}}>Probationary</option>
            <option value="1" {{ $employee->is_regular == 1 ? 'selected' : ''}}>Regular</option>
            <option value="2" {{ $employee->is_regular == 2 ? 'selected' : ''}}>Project Based</option>
        </select>
        &nbsp;
        &nbsp;
        <select name="employee_category" class="select2">
            <option value="0">Employee Category</option>
            <option value="1" {{ $employee->employee_category == 1 ? 'selected' : ''}}>Manager</option>
            <option value="2" {{ $employee->employee_category == 2 ? 'selected' : ''}}>Supervisor</option>
            <option value="3" {{ $employee->employee_category == 3 ? 'selected' : ''}}>Support</option>
            <option value="4" {{ $employee->employee_category == 4 ? 'selected' : ''}}>Rank</option>
        </select>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="form-group">
            
                <label>Additional Linkees</label>
                <div class="my-2 d-flex gap-2  p-2" style="width: 100%;flex-wrap: wrap;">
                        <div class="border border-success rounded-pill p-2 " style="font-size: 12px; min-width:100px;">
                            Ferlyn Ruiz
                            <span class="ms-2">x</span>
                        </div>
                </div>

                <div class="d-flex gap-2">

                    <select name="adtl_linkees[]" data-val="1" class="select2 process_linkee form-control">
                        <option value="0">Select a Linkee</option>
                        <?php
                        foreach($supervisors as $s):
                        ?>
                        <option value="{{ $s->id }}">{{$s->fullname()}}</option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                    <input type="hidden" id="hidden_id_1" value="">
                    <div class="">
                        <button class="btn btn-primary add-linkee">Add a Linkee</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>