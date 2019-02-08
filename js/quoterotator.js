var quoterotator= {
  quotation: ["WAEC does not prepare candidates for its examinations by establishing secondary schools or tutorial centres, and no such institutions are affiliated to the Council.","WAEC Supervisors are teachers nominated by the various State Ministries of Education.<p>They are actually responsible for conducting the exams at the various centres.<p>It is their responsibility to collect question papers from the custodian and return answer scripts to the custodian centres.</p>", "The marking of scripts is handled by examiners appointed by WAEC.<p>They are usually educationists who are familiar with the classroom situation and their identities are not supposed to be disclosed.</p>", "Established in 1952, the council has contributed to education in Anglophonic countries of West Africa (Ghana, Nigeria, Sierra Leone, Liberia, and the Gambia), with the number of examinations they have coordinated, and certificates they have issued."],
  milliseconds:550,         // should match the fade time
  iterationstoshowtext: 15, // 15 * 250 milliseconds = 3.75 seconds
  action:0,                 // the key to the whole thing
  id:-1,                    // the index of the last quotation shown
  divtofillwithquotes: "quotediv", // the name of the div to fill with quotes
  start: function (divtofill) {
    this.divtofillwithquotes=divtofill;
    setInterval("quoterotator.shownext()",this.milliseconds);
  },
  shownext: function () {
   var thediv=document.getElementById(this.divtofillwithquotes);
   var which =0;
   if (thediv) {
    if (this.action==0) { // fadein and changetext;
     do { which=Math.round(Math.random()*(this.quotation.length - 1)); }
     while (which==this.id);
     this.id=which;
     thediv.innerHTML=""+this.quotation[this.id]+"";
     thediv.className = "fadein";
     this.action++;
    } else if (this.action==this.iterationstoshowtext) {
      thediv.className = "fadeout";
      this.action=0;
    } else { this.action++; }
   }
  }
}