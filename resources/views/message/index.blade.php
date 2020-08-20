<div class="message-wrapper">
  <ul class="message">
    @foreach($messages as $message)
      <li class="message clearfix">
        <!--if message from id is equal to auth id then it is sent by login in user-->
        <div class="{{ ($message->from_id == Auth::id()) ? 'sent' : 'received' }}">
          <p>{{ $message->message }}</p>
          <p class="date">{{ date('d M y,h:i a', strtotime($message->created_at)) }}</p>
        </div>
      </li>
    @endforeach
  </ul>
</div>

<div class="input-text">
  <div class="row">
    <div class="col-md-10">
      <input type="text" name="message" class="sumbit">
    </div>
    <div class="col-md-2">
      <a class="btn btn-primary btn-message" href="#" role="button">送信</a>
    </div>
  </div>
</div>
