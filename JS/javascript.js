/**
 * Display JS object in console
 *
 * @uses JSON.stringify(value, replacer, space)
 * @see  https://developer.mozilla.org/en/docs/Web/JavaScript/Reference/Global_Objects/JSON/stringify
 */
const arr = ['cats', 'coffee', 'code'];
const obj = JSON.stringify(arr, null, 2);

console.log(obj);

/**
 * Listening for a click on elements
 *
 */
document.querySelector('.element').addEventListener('click', () => {
  console.log('It works!');
});


/**
 * Iterating Over a Collection of Elements
 *
 */
const elements = document.querySelectorAll('.element');

// Loop over all elements while i < number of elements
for (let i = 0; i < elements.length; i += 1) {
  elements[i].style.color = 'red';
}


/**
 * Get a random item from an array
 *
 */
const args = [42, 1337, 'coffee', 'cats', 404, 'toto'];
const randomItem = args[Math.floor(Math.random() * args.length)];


/**
 * Append an array to another array
 *
 */
const arrayOne = [42, 1337, { drink: 'coffee' }, 'cats'];
const arrayTwo = ['toto', 404, 'meow'];

// arrayOne = [42, 1337, { drink: 'coffee' }, 'cats', 'toto', 404, 'meow'];
Array.prototype.push.apply(arrayOne, arrayTwo);


/**
 * function to escape HTML
 * Will escape these characters: <, >, &, "
 */
function escapeHTML(text) {
  const replacements = { '<': '&lt;', '>': '&gt;', '&': '&amp;', '"': '&quot;' };

  return text.replace(/[<>&"]/g, function (char) {
    return replacements[char];
  });
}

const text = '<p class="someclass">Some "text"</p>';

// &lt;p class=&quot;someclass&quot;&gt;Some &quot;text&quot;&lt;/p&gt;
console.log(escapeHTML(text));
