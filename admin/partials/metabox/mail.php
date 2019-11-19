<div class="bootstra-iso">
  <div>
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
</div>
