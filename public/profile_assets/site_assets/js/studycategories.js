
var study_arr = new Array("6th Class", "7th Class", "8th Class", "9th Class", "10th Class", "11th Class", "12th Class", "NDA", "IIT-JEE", "PMT", "CLAT", "IIFT/NIFT", "SAT", "Gaokao", "CAT/MAT", "GATE", "GRE", "SSC", "UPSC", "GMAT", "LSAT", "MCAT", "Banking Exams", "Teaching Exams", "Police Exams", "Railway Exams", "IELTS", "TOFEL", "General knowledge", "Quantitative aptitude & Reasoning ability","Science & Technology","Business/Startups","Marketing","General Discussion");

// States
var st_a = new Array();
st_a[0]="";
st_a[1]="Science|Math|English";
st_a[2]="Science|Math|English";
st_a[3]="Science|Math|English";
st_a[4]="Science|Math|English";
st_a[5]="Science|Math|English";
st_a[6]="Physics|Chemistry|Biology|Math|English|Accounts|Economics";
st_a[7]="Physics|Chemistry|Biology|Math|English|Accounts|Economics";
st_a[8]="Mathematics|General Ability Test";
st_a[9]="Physics|Chemistry|Mathematics";
st_a[10]="Physics|Chemistry|Biology";
st_a[11]="English|Elementary mathematics|Legal Aptitude|Logical Reasoning";
st_a[12]="General Knowledge|Mathematics|English";
st_a[13]="Math Level 1|Math Level 2|Physics|Chemistry|Biology E/M|English|History|Language";
st_a[14]="Chinese|Mathematics|English|Japanese|Russian|French|Physics|Chemistry|Biology|History|Geography|Political Education";
st_a[15]="Mathematics|English|Data Interpretation & Analytical Reasoning|Quantitative Ability|Current Affairs";
st_a[16]="General Aptitude|Aerospace Engineering|Agricultural Engineering|Architecture and Planning|Biotechnology|Civil Engineering|Chemical Engineering|Computer Science and Information Technology|Chemistry|Electronics and Communication Engineering|Electrical Engineering|Ecology and Evolution|Geology and Geophysics|Instrumentation Engineering|Mathematics|Mechanical Engineering|Mining Engineering|Metallurgical Engineering|Physics|Production and Industrial Engineering|Petroleum Engineering|Textile Engineering and Fibre Science|Engineering Sciences|Life Sciences";
st_a[17]="Physics|Chemistry|Biology|Mathematics|Psychology|Literature in English";
st_a[18]="General Intelligence and reasoning|General awareness|Quantitative aptitude|English|Statistics";
st_a[19]="History|Geography|Political Science/Civics|Economics|General Science - Physics|Chemistry & Biology|Environmental Science|Sociology";
st_a[20]="Analytical Writing|Integrated Reasoning|Verbal Reasoning|Quantitative reasoning";
st_a[21]="Logical Reasoning|Analytical Reasoning|Reading Comprehension";
st_a[22]="Chemical and Physical Foundations of Biological Systems|Critical Analysis and Reasoning Skills|Biological and Biochemical Foundations of Living Systems|Psychological|Social|Psychological, Social, and Biological Foundations of Behavior";


function GroupSub( countryElementId, stateElementId ){
	
	var selectedCountryIndex = document.getElementById( countryElementId ).selectedIndex;

	var stateElement = document.getElementById( stateElementId );
	
	stateElement.length=0;	// Fixed by Julian Woods
	stateElement.options[0] = new Option('Select Study Group Sub Category','');
	stateElement.selectedIndex = 0;
	
	var state_arr = st_a[selectedCountryIndex].split("|");
	
	for (var i=0; i<state_arr.length; i++) {
		stateElement.options[stateElement.length] = new Option(state_arr[i],state_arr[i]);
	}
}

function Group(countryElementId, stateElementId){
	// given the id of the <select> tag as function argument, it inserts <option> tags
        
	var groupElement = document.getElementById(countryElementId);
	groupElement.length=0;
	groupElement.options[0] = new Option('Select Study Group Category','');
	groupElement.selectedIndex = 0;
	for (var i=0; i<study_arr.length; i++) {
		groupElement.options[groupElement.length] = new Option(study_arr[i],study_arr[i]);
	}

	// Assigned all countries. Now assign event listener for the states.

	if( stateElementId ){
		groupElement.onchange = function(){
			GroupSub( countryElementId, stateElementId );
		};
	}
}