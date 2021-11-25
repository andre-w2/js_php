const button = document.querySelector('#but');
let num = document.querySelector('#num');

axios.get('./api/user.php')
	.then(response => {
		num.innerText = `В системе людей: ${response.data}`
	})
	.catch(error => {
		console.log(error)
	})

button.addEventListener('click', e => {
    e.preventDefault();
    const login = document.querySelector('#login').value;
    const password = document.querySelector('#password').value;

    let status = document.querySelector('#status');

    if(login === '' && password === '') return false;

    axios({
        method: 'post',
        url: './api/api.php',
        data: {
        	login,
        	password,
        	methods: 'post'
        }
    })
    .then(response => {
     	let result = response.data.map(e => e.split(', '));
     	status.innerHTML = `Успешно: <br> Логин: ${result[0][0]}; <br> Пароль: ${result[0][1]}; <br> Хэш пароль: ${result[0][2]}`
		num.innerText = `В системе людей: ${result[0][3]}`
    })
    .catch(error => {
        console.log(error)
    })
})