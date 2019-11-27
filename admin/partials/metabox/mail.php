<div class="bootstra-iso">
  <div>
    <div class="form-group">
      <p>Form</p>
      <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#textModal">Text</button>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#textAreaModal">Text Area</button>
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#submitModal">Submit</button>
      </div>
      <p></p>
      <textarea class="form-control" id="inputForm" name="inputForm" rows="10"><?php echo $form_inputs;?></textarea>
    </div>
    <div class="form-group">
      <label for="inputEmailTo">To</label>
      <input type="text" class="form-control form-control-sm" value="<?php echo $to;?>" id="inputEmailTo" name="email-to" aria-describedby="emailToHelp" placeholder="To Address">
      <small id="emailToHelp" class="form-text text-muted">Help text here.</small>
    </div>
    <div class="form-group">
      <label for="inputEmailFrom">From</label>
      <input type="text" class="form-control form-control-sm" value="<?php echo $from;?>" id="inputEmailFrom" name="from" aria-describedby="emailFromHelp" placeholder="From">
      <small id="emailFromHelp" class="form-text text-muted">Help text here.</small>
    </div>
    <div class="form-group">
      <label for="inputSubject">Subject</label>
      <input type="text" class="form-control form-control-sm" value="<?php echo $subject;?>" id="inputSubject" name="subject" aria-describedby="inputSubjectHelp" placeholder="Subject">
      <small id="inputSubjectHelp" class="form-text text-muted">Help text here.</small>
    </div>
    <div class="form-group">
      <label for="inputAdditionalHeaders">Additional Headers</label>
      <textarea class="form-control" id="inputAdditionalHeaders" name="additional-headers" rows="3"><?php echo $additional_headers;?></textarea>
      <small id="inputAdditionalHeadersHelp" class="form-text text-muted">Help text here.</small>
    </div>
    <div class="form-group">
      <label for="inputMessageBody">Message Body</label>
      <textarea class="form-control" id="inputMessageBody" name="message-body" rows="3"><?php echo $message_body;?></textarea>
      <small id="inputMessageBodyHelp" class="form-text text-muted">Help text here.</small>
    </div>
  </div>

<!-- Modal Text-->
<div class="modal fade" id="textModal" tabindex="-1" role="dialog" aria-labelledby="textModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="textModalLabel">Add Text Input</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control form-control-sm" id="name-text">
              </div>
              <div class="form-group">
                <label for="label">label</label>
                <input type="text" class="form-control form-control-sm" id="label-text">
              </div>
              <div class="form-group">
                <label for="class">Class</label>
                <input type="text" class="form-control form-control-sm" id="class-text">
              </div>
            </div><!--col-md-6-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="class">ID</label>
                <input type="text" class="form-control form-control-sm" id="id-text">
              </div>
              <div class="form-group">
                <label for="required">Required</label>
                <select class="form-control form-control-sm" id="required">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </div>
              <div class="form-group">
                <label for="is-email">Is Email</label>
                <select class="form-control form-control-sm" id="is-email">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </div>
            </div><!-- col-md-6-->
          </div><!-- row-->
        </div><!-- container-fluid-->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary insert-text">Insert Text Tag</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Text-->

<!-- Modal Text Area-->
<div class="modal fade" id="textAreaModal" tabindex="-1" role="dialog" aria-labelledby="textAreaModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="textAreaModalLabel">Add Text Area Input</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control form-control-sm" id="name-textarea">
              </div>
              <div class="form-group">
                <label for="label">label</label>
                <input type="text" class="form-control form-control-sm" id="label-textarea">
              </div>
              <div class="form-group">
                <label for="class">Class</label>
                <input type="text" class="form-control form-control-sm" id="class-textarea">
              </div>
            </div><!--col-md-6-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="class">ID</label>
                <input type="text" class="form-control form-control-sm" id="id-textarea">
              </div>
              <div class="form-group">
                <label for="required-textarea">Required</label>
                <select class="form-control form-control-sm" id="required">
                  <option value="0">No</option>
                  <option value="1">Yes</option>
                </select>
              </div>
            </div><!-- col-md-6-->
          </div><!-- row-->
        </div><!-- container-fluid-->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary insert-textarea">Insert Text Area Tag</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Text Area-->

<!-- Modal Submit-->
<div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="submitModalLabel">Modal Submit Button Input</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control form-control-sm" id="name-submit">
              </div>
              <div class="form-group">
                <label for="label">label</label>
                <input type="text" class="form-control form-control-sm" id="label-submit">
              </div>
              <div class="form-group">
                <label for="class">Class</label>
                <input type="text" class="form-control form-control-sm" id="class-submit">
              </div>
            </div><!--col-md-6-->
            <div class="col-md-6">
              <div class="form-group">
                <label for="class">ID</label>
                <input type="text" class="form-control form-control-sm" id="id-submit">
              </div>
            </div><!-- col-md-6-->
          </div><!-- row-->
        </div><!-- container-fluid-->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary insert-submit">Insert Submit Tag</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal Submit-->

</div>
