async function newQuestion(elem)
{
	let answer = document.querySelector('[name="answer"]:checked');
	if(answer || elem.hasAttribute("data-prev"))
	{
		let data = new FormData();
		if(!elem.hasAttribute("data-prev"))
		{
			data.append("answerID", answer.getAttribute("data-valueID"));
			data.append("answer", answer.getAttribute("data-value"));
		}
		else
		{
			data.append("prev", "Y");
		}
		data.append("questionID", elem.getAttribute("data-questionID"));
		data.append("question", elem.getAttribute("data-question"));
		if(elem.hasAttribute("data-questionIDnew")) data.append("questionIDnew", elem.getAttribute("data-questionIDnew"));
		if(elem.hasAttribute("data-questionEnd")) data.append("questionEnd", elem.getAttribute("data-questionEnd"));

		let response = await fetch('', {
			method: 'POST',
			body: data
		});
		
		let result = await response.text();
		if(elem.hasAttribute("data-questionEnd"))
		{
			window.location.replace("/account/tests/");
		}
		else{
			document.getElementById("question_block").innerHTML = result;
		}
	}
}