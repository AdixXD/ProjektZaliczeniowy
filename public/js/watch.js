// variables
const timeBox=document.getElementById('time');
const dateBox=document.getElementById('date');
const body=document.querySelector('body');
let displaySeconds=true;
let displayDate=true;
const bgs=['nature', 'city', 'sky', 'constructionsAndVehicles'];
let bg=0;
const bgsNr=[60, 60, 15, 15];
let date=new Date();
function tick()
{
	date=new Date();
	let day=date.getDate();
	let month=date.getMonth()+1;
	let year=date.getFullYear();
	let hour=date.getHours();
	let minute=date.getMinutes();
	let second=date.getSeconds();
	if(day<10) day='0'+day;
	if(month<10) month='0'+month;
	if(hour<10) hour='0'+hour;
	if(minute<10) minute='0'+minute;
	if(second<10) second='0'+second;
	timeBox.innerHTML=hour+':'+minute;
	if(displaySeconds) timeBox.innerHTML+=':'+second;
	dateBox.innerHTML=day+'.'+month+'.'+year;
	if(second==0) updateBg();
}
tick();
// ticking
setInterval(tick, 1000);
