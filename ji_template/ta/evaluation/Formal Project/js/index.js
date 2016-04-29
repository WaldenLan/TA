updateFooterTime = (function() {
   var serverTzDisplay='CST';
   var serverLocalOffset = (new Date()).getTimezoneOffset()*60000;
   return function() {
       var offsetDate = new Date((new Date()).getTime() - serverLocalOffset);
       var dateString = offsetDate.toUTCString()
           .replace(/GMT/, serverTzDisplay)
           .replace(/UTC/, serverTzDisplay);

       document.getElementById('serverTime').innerHTML = dateString;


       setTimeout('updateFooterTime()', 1000);
   };
})();