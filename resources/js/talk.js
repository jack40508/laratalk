(() => { function fn() {
  $('#a3rt-talk-button').click(() => {
    const params = {
      apikey: "DZZpEiJNTW1sSsQ7B8MkLb2Hk5UJFPj3",
      query: $('#a3rt-talk-message').val()
    };
    $.post('https://api.a3rt.recruit-tech.co.jp/talk/v1/smalltalk', params, (result) => {
      let tag = `<div>status: ${result.status}</div>
      <div>message: ${result.message}</div>
      `;
      if (result.status == 0) {
        tag += `<div>${result.results[0].reply}</div>`;
      }
      $('#a3rt-talk-result').html(tag);
    }, 'json');
    return false;
  });
};
  if (document.readyState != 'loading') {fn()}
  else {document.addEventListener('DOMContentLoaded', fn)}
})();

/*
(() => { function fn() {
  $('#a3rt-talk-button').click(() => {
    const params = {
      apikey: $('#a3rt-talk-api-key').val(),
      query: $('#a3rt-talk-message').val()
    };
    $.post('https://api.a3rt.recruit-tech.co.jp/talk/v1/smalltalk', params, (result) => {
      let tag = `<div>status: ${result.status}</div>
      <div>message: ${result.message}</div>
      `;
      if (result.status == 0) {
        tag += `<div>${result.results[0].reply}</div>`;
      }
      $('#a3rt-talk-result').html(tag);
    }, 'json');
    return false;
  });
};
  if (document.readyState != 'loading') {fn()}
  else {document.addEventListener('DOMContentLoaded', fn)}
})();
*/
