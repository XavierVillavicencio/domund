import AppRouter from "router/AppRouter";

function mirarLog(){
  var myHeaders = new Headers();
  myHeaders.append("Authorization", "Bearer CfDJ8AOF58RPtbtLjXIOGds9JgWwR2oOk0lzneKY6gGeXJId__Cv69rlLyXuQ2PeJPF5ebVvJ55emzkHaqyjxdYi6-2jdFDiquXQAJwnh9KHN7efNojcaJaeR07LTSn3uTorGU3xAbY3M-rHEOk1hF6-jG7AIveEcbTxmSpLZm2AG73FeZmLUBjrmj0TPeXTsKobhA");
  myHeaders.append("Content-Type", "application/x-www-form-urlencoded");

  var urlencoded = new URLSearchParams();
  urlencoded.append("con_text_description", "nuqwe");

  var requestOptions = {
    method: 'GET',
    headers: myHeaders,
    body: urlencoded,
    redirect: 'follow'
  };

  fetch("https://domund.test/housing/condos/1", requestOptions)
    .then(response => response.text())
    .then(result => console.log(result))
    .catch(error => console.log('error', error));
}

mirarLog();

function App() {
  return <AppRouter />;
}

export default App;
