function complete_period(studentid, period, todo, noreload) {
    let req = new XMLHttpRequest();
    req.open("POST", "requests/complete.php", true);
    let data = new FormData();
    data.append('period', period);
    data.append('studentId', studentid);
    data.append('todo', todo);

    req.onload = () => {
        if(noreload == true) {
            return;
        }
        window.location = window.location.href.split("?")[0];
    }

    req.send(data);
}
