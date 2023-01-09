window.addEventListener('popstate', function() {
    alert(1);
    console.log(window.globalConfig);
});

window.addEventListener('locationchange', function(){
    alert(2);
    console.log(window.globalConfig);
});

window.addEventListener('replaceState', function(){
    alert(3);
    console.log(window.globalConfig);
});

window.addEventListener('pushstate', function(){
    alert(4);
    console.log(window.globalConfig);
});

window.addEventListener('onpushstate', function(){
    alert(5);
    console.log(window.globalConfig);
});

window.onpopstate = (event) => {
    alert(6);
    console.log(`location: ${document.location}, state: ${JSON.stringify(event.state)}`);
};

window.addEventListener('changestate', function (e) {
    alert(7);
    console.log(window.globalConfig);
});
