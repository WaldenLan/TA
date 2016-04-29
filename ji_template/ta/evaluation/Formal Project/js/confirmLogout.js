/**
 * Created by user on 4/7/16.
 */
function confirmLogout() {
    if (confirm("Are you sure to log out?")==true){
        location.href="../Login/index.html";
    }
    else {
        location.href="#";
    }
}