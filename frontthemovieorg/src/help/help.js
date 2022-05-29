const convertDate = data => {
    let today  = new Date(data);
    let options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    return today.toLocaleDateString("pt-br", options);
}

export default convertDate;