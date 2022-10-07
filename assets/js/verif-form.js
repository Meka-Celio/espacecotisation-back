'use strict'

/**
 * Vérification des données envoyer par les formulaires :
 * 1- Récupérer les inputs à vérifier
 * 2- Récupérer les valeurs des dit inputs
 * 3- Récupérer les indices de vérification
 * 4- Activer les fonctions de vérification
 * 5- Renvoyer les résultats en cas d'erreurs
 * 6- Laissez Passer si tout est ok
*/

/****************************************************
 * 	Donnees
***************************************************/
let form 		= document.getElementsByTagName('form')

/*const stop = (number) => {
	const numeral = number ? number : 17
	return `It's the numero ${numeral}`
}

let check = (!values[0].trim() == "") ? ((values[0].length >= 5) ? values[0] : 0) : 0
console.log(check)*

/****************************************************
 * 	Fonctions
***************************************************/

function verif (rule, value)
{
	let validation 	= [];
	let check 	= "";
	let pattern = ""; 

	switch (rule)
	{
		case 'text':
			check = (!value.trim() == "") ? 1 : 0
			validation.push(check)
		break;
		case 'email':
			pattern = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i
			check = (value.match(pattern)) ? 1 : 0
			validation.push(check)
		break;
		case 'password':
			check = (!value.trim() == "") ? ((value.length >= 5) ? 1 : 0) : 0
			validation.push(check)
		break;
		case 'verif-password':
			let formgroup 	= 	document.querySelector('[data-rule="password"]')
			let originValue =	formgroup.querySelector('input').value 
			check = (value == originValue) ? ((originValue == 0) ? 0 : 1) : 0
			validation.push(check)
		break;
		case 'tel':
		break;
		default:break;
	}

	return validation
}

/****************************************************
 * 	Main
***************************************************/
form[0].addEventListener('click', (event) => {
	
	// elements sur lesquels seront affectées les class erreurs
	let formgroups 	= document.querySelectorAll('[data-rule]') 
	let inputs 		= [];
	let rules 		= [];
	let values 		= [];

	for (let i=0; i<formgroups.length; i++) {
		inputs.push(formgroups[i].querySelector('input'))
		rules.push(formgroups[i].getAttribute('data-rule'))
		values.push(inputs[i].value)
	}


	let validate = []
	let ok = 0

	for (let j=0; j<values.length;j++)
	{
		validate.push(verif(rules[j], values[j]))
		if (validate[j] == 0)
		{
			formgroups[j].classList.add('has-error')
			formgroups[j].classList.remove('has-success')
		}
		else
		{
			formgroups[j].classList.add('has-success')
			formgroups[j].classList.remove('has-error')
			ok += 1
		}
	}

	if (!ok == rules.length) {
		event.preventDefault()
	}
})
