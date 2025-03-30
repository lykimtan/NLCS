document.querySelector(".footer-form").addEventListener("submit", function (event) {
    event.preventDefault(); 
    let message = document.querySelector(".input-letter").value;
    let recipientEmail = "lykimtanjjj@gmail.com"; 

    if (message.trim() !== "") {
      let mailtoLink = `mailto:${recipientEmail}?subject=Newsletter Message&body=${encodeURIComponent(message)}`;
      window.location.href = mailtoLink;
    } else {
      alert("Please enter a message before sending.");
    }
  });