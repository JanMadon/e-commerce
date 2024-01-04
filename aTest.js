const num = 1254.123
const afterDot = num.toString().split('.');
console.log();
if(afterDot.length > 1 && afterDot[1].length > 2) {
        console.log('nie prawidłowe');
} 
console.log(afterDot[1]);