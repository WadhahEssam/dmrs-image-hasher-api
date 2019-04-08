const puppeteer = require('puppeteer');


// infromation about the user that you want to search for
const userToSearch = 'john';

(async () => {
  const browser = await puppeteer.launch({headless: false});
  const page = await browser.newPage();
  
  await page.goto('https://c9.io/login');
  await page.setViewport({height: 800, width: 1200});

  // await page.waitForSelector('.lb-col > .lb-border-p > .lb-small-v-margin > .lb-btn-p > span')
  // await page.click('.lb-col > .lb-border-p > .lb-small-v-margin > .lb-btn-p > span')

  // await page.waitForNavigation();
  // #id-username

  await page.waitFor(1000);

  let pages = await browser.pages();
  console.log(pages.length);

  await page.waitForSelector('.wrap > form > fieldset > label > #id-username')
  await page.click('.wrap > form > fieldset > label > #id-username')
  await page.keyboard.type('435108270@student.ksu.edu.sa');

  await page.waitForSelector("#id-password")
  await page.click("#id-password")
  await page.keyboard.type('112233esamhaider');



  await page.click('#wrapper-main > article > section > div > section > form > fieldset > div.wrap > button');

  await page.waitForNavigation();


  await page.waitForSelector('.row > #workspace-card-image-hasher > section > .text-right > .button:nth-child(3)')
  await page.click('.row > #workspace-card-image-hasher > section > .text-right > .button:nth-child(3)')

  await page.waitFor(5000);

  pages = await browser.pages();
  console.log(pages.length);

  await pages[0].waitFor(20 * 1000)
  console.log('finished')
  await pages[0].click('#q3 > div.c9-toolbarbutton-glossy.runbtn.stopped.c9-toolbarbutton-glossyIconl');
  await pages[0].keyboard.press('F5')

  // await newPage.waitForNavigation();

  // await newPage.keyboard.press('F5')
  // await newPage.waitFor(2000);
  // await newPage.keyboard.press('F5')
  // all what you hae to do now is just wait

  await pages[0].screenshot({ path: 'github.png' });
  
  
  browser.close();
})();