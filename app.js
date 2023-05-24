function updateMessages() {
    const textArea = document.getElementById("recive");
    var xhr = new XMLHttpRequest();
  
    // Configure the request
    xhr.open('GET', 'getmessages.php', true);
  
    // Set up a callback function to handle the response
    xhr.onreadystatechange = function() {

      if (xhr.readyState === 4 && xhr.status === 200) {
        // Update the textarea with the response data
        let res = JSON.parse(xhr.responseText)
        textArea.value = ""

        res.forEach(item => {
          textArea.value += item["name"] + " : " + item["message"] + " : " + item["time"] + "\n"; 
        });
      }
    };
  
    // Send the request
    xhr.send();
  }
  
function prosses(e){
  if((e.key == "Enter" && e.type == "keydown") || (e.type == "click")){
    text = document.getElementById("send").value
    document.getElementById("send").value = ""
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'sendmessages.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = () => {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Update the element with the response data
          console.log(xhr.responseText);
        }
      };
      var data = new URLSearchParams();
      data.append('message', text);

      xhr.send(data);
  }
  
};
  // Call updateMessages initially
  updateMessages();
  
  // Set up interval to update messages every 5 seconds
  setInterval(updateMessages, 5000);

document.getElementById("send").addEventListener("keydown",(e)=>{
    prosses(e)
})

document.getElementById("sendbtn").addEventListener("click",(e)=>{
    prosses(e)
})
