const account1 = {
    id:'1001',
    owner: 'user01',
    movements: [200, 450, -400, 3000, -650, -130, 70, 1300],
    interestRate: 1.2, // %
    pin: 1111,
    movementsDates: [
      '2019-11-18T21:31:17.178Z',
      '2019-12-23T07:42:02.383Z',
      '2020-01-28T09:15:04.904Z',
      '2020-04-01T10:17:24.185Z',
      '2020-05-08T14:11:59.604Z',
      '2021-07-26T17:01:17.194Z',
      '2022-02-10T23:36:17.929Z',
      '2022-02-14T10:51:36.790Z',
    ]
  };
const account2 = {
    id:'1002',
    owner: 'user02',
    movements: [5000, 3400, -150, -790, -3210, -1000, 8500, -30],
    interestRate: 1.5, // %
    pin: 2222,
    movementsDates: [
      '2019-11-01T13:15:33.035Z',
      '2019-11-30T09:48:16.867Z',
      '2019-12-25T06:04:23.907Z',
      '2020-01-25T14:18:46.235Z',
      '2020-02-05T16:33:06.386Z',
      '2020-04-10T14:43:26.374Z',
      '2021-06-25T18:49:59.371Z',
      '2022-02-15T12:01:20.894Z',
    ]
  }; 
const account3 = {
    id:'1003',
    owner: 'user03',
    movements: [200, -200, 340, -300, -20, 50, 400, -460],
    interestRate: 0.7, // %
    pin: 3333,
    movementsDates: [
      '2019-11-01T13:15:33.035Z',
      '2019-11-30T09:48:16.867Z',
      '2019-12-25T06:04:23.907Z',
      '2020-01-25T14:18:46.235Z',
      '2020-02-05T16:33:06.386Z',
      '2020-04-10T14:43:26.374Z',
      '2020-06-25T18:49:59.371Z',
      '2020-07-26T12:01:20.894Z',
    ]
  };
const account4 = {
    id:'1004',
    owner: 'user04',
    movements: [430, 1000, 700, 50, 90],
    interestRate: 1,
    pin: 4444,
    movementsDates: [
      '2019-11-01T13:15:33.035Z',
      '2019-12-25T06:04:23.907Z',
      '2020-01-25T14:18:46.235Z',
      '2020-02-05T16:33:06.386Z',
      '2020-06-25T18:49:59.371Z',
    ]
  };

let currentUser;
let sortFlag=0;
let loginFlag=0;
let totalBalance;
let timerInterval;

const appContainer=document.querySelector('.app');
const balanceLabel=document.querySelector('.balance-value');
const totalWithdrawalLabel=document.querySelector('.summary_value_out');
const totalDepositLabel=document.querySelector('.summary_value_in');
const interestLabel=document.querySelector('.summary_value_interest');
const tiemrLabel=document.querySelector('.timer');
const dateLabel=document.querySelector('.date');
const btnTransfer=document.querySelector('.btn-transfer');
const btnSort=document.querySelector('.sort');
const usernameInput=document.querySelector('.input-username');
const passwordInput=document.querySelector('.input-password');
const transferValueInput=document.querySelector('.transfer-to-value');
const transferIdInput=document.querySelector('.transfer-to-input');
const movmentsPlatform=document.querySelector('.movments');
let movsLoaderHolder;
let movsLoader;
const refreshBtn=document.querySelector('.refresh__btn');
const defaultMovsInner='<div class="movements__holder"><div class="movements__loader"></div><p class="empty__movs--error"> </p></div>';
const accounts = [account1, account2, account3, account4];
/* btnLogin.addEventListener('click',function(e){
  e.preventDefault();
  console.log(e);
}); */
window.addEventListener('load',function(){
  deleteLoader();
  loginProccess();
});
function reSelectLoaders(){
  movsLoaderHolder=document.querySelector('.movements__holder');
  movsLoader=document.querySelector('.movements__loader');
}
function loginProccess(){
  exitAcc(); 
  reSelectLoaders();
  showMovLoader();
  loginFlag=1;
  trueEnformation=1;
  sortFlag=0;
  welcomeUser();
  refreshMovs();
  timerInterval= window.setInterval(calTimer,1000);
  
}

function refreshMovs(){
  reSelectLoaders();
  const xmlhttp=new XMLHttpRequest();
  xmlhttp.onload=function(){
    const movObj=this.responseText;
    currentUser=JSON.parse(movObj);
    if(currentUser.movements.length==0){
      const errHolder=document.querySelector('.empty__movs--error');
      errHolder.innerHTML="تراکنشی جهت نمایش وجود ندارد";
      movsLoader.classList.remove('movements__loader');
      movsLoader.classList.add('hidden');
    }
    else{
      updateApp();
      deleteMovLoader();
    }
  }
  xmlhttp.open("GET", "/readMovements.php");
  xmlhttp.send();
}
function showMovLoader(){
  movsLoader.classList.add('movements__loader');
  movsLoader.classList.remove('hidden');
  movsLoaderHolder.classList.add('movements__holder');
  movsLoaderHolder.classList.remove('hidden');
}
function clearMovsToDefault(){
  movmentsPlatform.innerHTML="";
  movmentsPlatform.innerHTML=defaultMovsInner;
}
function deleteMovLoader(){
  movsLoader.classList.toggle('movements__loader');
  movsLoader.classList.toggle('hidden');
  movsLoaderHolder.classList.toggle('movements__holder');
  movsLoaderHolder.classList.toggle('hidden');
}
refreshBtn.addEventListener('click',function(ev){
  ev.preventDefault();
  clearMovsToDefault();
  showMovLoader()
  refreshMovs();
});
function welcomeUser(){
  appContainer.style.opacity=100;
}

function displayMovments(sort){
  let userTmp=JSON.parse(JSON.stringify(currentUser));
  let datePriceArr=[]
  userTmp.movements.forEach(function(ele,i){
    datePriceArr.push({
      'date':userTmp.movementsDates[i],
      'price':ele
    });
  });
  
  if(sort>=1)
  {
    datePriceArr.sort((a,b)=>Math.abs(a.price)-Math.abs(b.price))
  }
  else if(sort<=-1)
  { 
    datePriceArr.sort((a,b)=>Math.abs(b.price)-Math.abs(a.price));
  }
  movmentsPlatform.innerHTML="";
  datePriceArr.forEach(function(ele,i){
    const transferType= (ele.price<0) ?'movment-withdrawal' :'movment-deposit';
    const transferLabel=ele.price<0 ?'برداشت ': 'واریز' ;
    const daysPast=Math.round((new Date-new Date(ele.date))/(1000*60*60*24));
    let mDateStr;
    if(daysPast==0)
    mDateStr='امروز';
    else if(daysPast==1)
    mDateStr='دیروز';
    else if(daysPast<=7)
    mDateStr=`${daysPast} روز پیش`;
    else
    mDateStr=`${new Date(ele.date).toLocaleDateString('fa-IR')}`;
    let htmlStr=`
    <div class="movments-row">
    <div class="movments-value">${Intl.NumberFormat().format(ele.price)}</div>
    <div class="movments-date">${mDateStr}</div>
    <div class="movments-type ${transferType}">${i+1}. ${transferLabel } </div>
    </div>`;
    movmentsPlatform.insertAdjacentHTML('afterbegin',htmlStr);
  });  
}

function calBalance(){
  totalBalance=currentUser.movements.reduce((acc,ele)=>acc+ele);
  balanceLabel.innerHTML="";
  
  balanceLabel.innerHTML=Intl.NumberFormat().format(totalBalance)+' <sup class="balance-unit">تومان</sup>';
}

function calSummary(){
  const totalDeposit=currentUser.movements.filter(function(ele){
    return ele>0;
  }).reduce((acc,ele)=>acc+ele,0);
  const totalWithdrawal=currentUser.movements.filter(function(ele){
    return ele<0;
  }).reduce((acc,ele)=>acc+ele,0);
  totalDepositLabel.innerHTML="";
  totalWithdrawalLabel.innerHTML="";
  totalDepositLabel.innerHTML=Intl.NumberFormat().format( totalDeposit);
  totalWithdrawalLabel.innerHTML=Intl.NumberFormat().format(totalWithdrawal);
}
function calInterest(){
  const interestValue=totalBalance*(currentUser.interestRate/100);
  interestLabel.innerHTML="";
  interestLabel.innerHTML=Intl.NumberFormat().format(interestValue);
}
function exitAcc(){
  loginFlag=0;
  appContainer.style.opacity=0;
  window.clearInterval(timerInterval);
  tiemrLabel.innerHTML='10:00';
}
function updateApp(){
  if(sortFlag==0)
    btnSort.innerHTML="&HorizontalLine;";
  displayMovments(sortFlag);
  calBalance();
   let today = new Date().toLocaleDateString('fa-IR');
   dateLabel.innerHTML=today;
   calSummary();
   calInterest();
   
}
function calTimer(){

  const rawTimer=tiemrLabel.innerHTML;
  let min=Number(rawTimer.split(':')[0]);
  let sec=Number(rawTimer.split(':')[1]);
  if(sec==0){
    if(min==0){
      exitAcc();
    }
    else{
      sec=59;
      min-=1;
    }
  }
  else  
    sec-=1;
    tiemrLabel.innerHTML="";
    tiemrLabel.innerHTML=`${min}:${sec}`;
}
function transferMoney(e){
  e.preventDefault();
  transferValue=Number( transferValueInput.value);
  transferId=transferIdInput.value;
  let errorMessage="";
  const xmlhttpValidation=new XMLHttpRequest();
  xmlhttpValidation.onload=function(){
    const movObj=this.responseText;
    movObj=JSON.parse( movObj);
    if(movObj.hasError){
      
    }
    else{

    }
    debugger;
    console.log(movObj);
  }
  debugger;
  xmlhttpValidation.open('POST','/transferProcess.php',true);
  xmlhttpValidation.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  xmlhttpValidation.send('transferUsername='+transferId+'&transferValue='+transferValue);


  // if(transferValue<=0)
  //   errorMessage+="Invalid Transfer Value \r\n";
  // const transferAccIndex=accounts.findIndex((ele)=>ele.id==transferId);
  // if(transferAccIndex==-1)
  //   errorMessage+="Account Not Found \r\n";
  // if(totalBalance < Number( transferValue))
  //   errorMessage+="There aren't enough deposite \r\n";
  // if(errorMessage!="")
  //   alert(errorMessage);
  // else{
  //   accounts[transferAccIndex].movements.push(transferValue);
  //   accounts[transferAccIndex].movementsDates.push(`${new Date().toISOString()}`);
  //   currentUser.movements.push(transferValue*-1);
  //   currentUser.movementsDates.push(`${new Date().toISOString()}`);
  //   console.log(accounts[transferAccIndex]);
  //   updateApp();
  // }
}
btnSort.addEventListener('click',function(){
  btnSort.innerHTML="";
  if(sortFlag==-1)
    {
      sortFlag=0;
    btnSort.innerHTML="&HorizontalLine;";}
    else{
  sortFlag=sortFlag==0?1:sortFlag*-1;
  btnSort.innerHTML=(sortFlag==1)?"&DownArrow;":"&UpArrow;";
}
  displayMovments(sortFlag);
});
btnTransfer.addEventListener('click',transferMoney,false);