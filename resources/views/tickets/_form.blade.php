{{ csrf_field() }}
<div class="form-group">
  <label for="name">Your name:</label>
  <input type="text" class="form-control" name="name" required="required" value="{{ old('name', $ticket->user) }}">
</div>
<div class="form-group">
  <label for="subject">Your subject:</label>
  <input type="text" class="form-control" name="subject" required="required" value="{{ old('subject', $ticket->subject) }}">
</div>
<div class="form-group">
  <label for="urgency">How urgent is your matter?</label>
  <select class="form-control" name="urgency" required="required">
    @foreach($ticket->urgencyOptions as $option)
      @if(!old('urgency'))
        <option {{ @$ticket->urgency === $option ? 'selected' : '' }}>{{ $option }}</option>
      @else
        <option {{ old('urgency') === $option ? 'selected' : '' }}>{{ $option }}</option>
      @endif
    @endforeach
  </select>
</div>
<div class="form-group">
  <label for="description">Describe your matter here:</label>
  <textarea class="form-control" name="description" rows="7" required="required">{{ old('description', $ticket->description) }}</textarea>
</div>
@if(count($ticket->files) > 0)
  <hr class="my-4">
  <h5>Attachments:</h5>
  <div>
    @foreach($ticket->files as $file)
      <div><span class="badge badge-pill badge-info">{{ $file->filename_old }}</span> &nbsp;<a href="{{route('removeFile', ['id'=>$file->id])}}"><span class="badge badge-pill badge-danger">X</span></a></div>
    @endforeach
  </div>
  <hr class="my-4">
@endif
<div id="attachemens">
  <div class="form-group">
    <label for="file">Attach a file:</label>
    <input type="file" name="files[]">
  </div>
</div>

<div style="margin-bottom: 50px">
  <button class="btn btn-default btn-sm" id="addFile">Add more files</button>
</div>
<div class="form-group">
  <button class="btn btn-primary" type="submit">Submit</button>
  <a href="{{route('index')}}" class="btn btn-default">Back</a>
</div>