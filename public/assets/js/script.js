let arrow = document.querySelectorAll(".arrow");
for (var i = 0; i < arrow.length; i++) {
  arrow[i].addEventListener("click", (e)=>{
 let arrowParent = e.target.parentElement.parentElement;//selecting main parent of arrow
 arrowParent.classList.toggle("showMenu");
  });
}

let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".bx-menu");
console.log(sidebarBtn);
sidebarBtn.addEventListener("click", ()=>{
  sidebar.classList.toggle("close");
});

// document.addEventListener("DOMContentLoaded", function () {
//   fetchNotifications();

//   function fetchNotifications() {
//       fetch("{{ route('user.getNotifications') }}")
//           .then(response => response.json())
//           .then(data => {
//               let dropdown = document.getElementById("notificationDropdown");
//               let countBadge = document.getElementById("notificationCount");

//               dropdown.innerHTML = ""; // Clear previous notifications

//               if (data.length > 0) {
//                   countBadge.innerText = data.length; // Show count
//                   data.forEach(notification => {
//                       let item = document.createElement("li");
//                       item.innerHTML = `<a class="dropdown-item" href="#">${notification.message}</a>`;
//                       dropdown.appendChild(item);
//                   });
//               } else {
//                   countBadge.innerText = "";
//                   let item = document.createElement("li");
//                   item.innerHTML = `<a class="dropdown-item" href="#">No new notifications</a>`;
//                   dropdown.appendChild(item);
//               }
//           })
//           .catch(error => console.error("Error fetching notifications:", error));
//   }

//   setInterval(fetchNotifications, 5000); // Refresh every 5 seconds
// });

