

const array = [1, 'a', 'b', 8]
const newArray = array.filter((_, index) => index !== 2) // [ 1, 'a', 8 ]
const newArray2 = array.filter((el, index) => el * 2 ) // [ 1, 'b', 8 ]

console.log(newArray2)