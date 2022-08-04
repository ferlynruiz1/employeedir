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
  <table class="_table">
    <thead>
        <td>List of Linkees</td>
        <td>Actions</td>
    </thead>
    <tbody>
        <tr>
            <td>sample</td>
            <td>
                <div class="d-flex gap-1">
                    <a href="" class="btn btn-outline-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                        </svg>
                    </a>
                    <form action="" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
    </tbody>
</table>


    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                
              
                <label>Additional Linkees</label>
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
            </div>
        </div>
        <div class="col-md-1">
            <label>&nbsp;</label>
            <button class="btn btn-primary add-linkee">Add a Linkee</button>
        </div>
    </div>
</div>