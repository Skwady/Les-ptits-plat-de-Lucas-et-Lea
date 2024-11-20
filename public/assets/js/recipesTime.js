function convertMinutesToHours(minutes) {
    if (minutes < 60) {
        return `${minutes}min`;
    }

    const hours = Math.floor(minutes / 60);
    const remainingMinutes = minutes % 60;

    if (remainingMinutes > 0) {
        return `${hours}h ${remainingMinutes}min`;
    }else if (hours > 0 && remainingMinutes == 0) {
        return `${hours}h`;
    }
    return 'aucun';
}

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll("[data-prep-time]").forEach((element) => {
        const minutes = parseInt(element.getAttribute("data-prep-time"));
        element.innerText = convertMinutesToHours(minutes);
    });

    document.querySelectorAll("[data-cook-time]").forEach((element) => {
        const minutes = parseInt(element.getAttribute("data-cook-time"));
        element.innerText = convertMinutesToHours(minutes);
    });

    document.querySelectorAll("[data-rest-time]").forEach((element) => {
        const minutes = parseInt(element.getAttribute("data-rest-time"));
        element.innerText = convertMinutesToHours(minutes);
    });
});

