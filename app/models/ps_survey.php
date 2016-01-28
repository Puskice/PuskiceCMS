<?php

class Ps_survey extends Eloquent {
	// protected $table = 'surveys';
	protected $fillable = [];

	public static function getSubjects($semester,$department){
		//recalculate from form parameters
		// $semester = 2*$year-1;
		// $dep = ($department<3) ? 0 : ($department-2);

		//fetch subjects
		$subjects = DB::table('ps_subjects')->where('department',$department)->where('semester',$semester)->get();
		
		//get subject names
		foreach ($subjects as $key => $subject) {
			$name = DB::table('ps_news')->where('id',$subject->news_id)->pluck('title');

			if(mb_substr($name,0,7) === mb_substr("Изборни",0,7)){
				unset($subjects[$key]);
			} else {
				if(mb_substr($name, 0, 6 ) === mb_substr("Страни",0,6)){
					$name = "Eнглески језик ".substr($name,-1);
				}
				$subject->title = $name;
			}
		}	
		return $subjects;
	}

	public function prepareOverallResults(){
		$survey = Ps_survey::where('active',1)->first();
		//check if survey exists
		// if(is_null($survey) || $survey->id!=$id){
		// 	$message = "Tražena anketa ne postoji ili nije aktivna.";
		// 	return View::make('surveys.error')->with('message',$message);
		// } else {
		$entries = Ps_surveyeval::all();
		$appd = array();
		$appd['ukupno'] = $this->createAnswer('Ukupno','sum-data');
		$appd['prva'] = $this->createAnswer('Prva godina','sum-data');
		$appd['druga'] = $this->createAnswer('Druga godina','sum-data');
		$appd['treca'] = $this->createAnswer('Treća godina','sum-data');
		$appd['cetvrta'] = $this->createAnswer('Četvrta godina','sum-data');
		$appd['isit'] = $this->createAnswer('Informacioni sistemi i tehnologije','sum-data');
		$appd['men'] = $this->createAnswer('Menadžment','sum-data');
		$appd['om'] = $this->createAnswer('Operacioni menadžment','sum-data');
		$appd['uk'] = $this->createAnswer('Upravljanje kvalitetom','sum-data');
		foreach ($entries as $key => $entry) {
			try {
				$newsid = $entry->subject->news->id;
			} catch (Exception $e) {
				dd($entry);
			}
			

			if(!array_key_exists($newsid, $appd)){
				//kreiranje za predmete
				$appd[$newsid] = $this->createAnswer($entry->subject->news->title);
			}
			$res_arr = explode(",", $entry->result);
			$department_semester = "dep".$entry->surveyentry->department."sem".$entry->surveyentry->semester;
			if(!in_array($department_semester, $appd[$newsid]['classes'])){
				array_push($appd[$newsid]['classes'], $department_semester);
			}
			foreach ($res_arr as $key => $res) {

				// if(!is_array($appd[$newsid][++$key])){
				$appd[$newsid][++$key][$res]+=1;
				$appd['ukupno'][$key][$res]+=1;
				switch ($entry->surveyentry->department) {
					case 0:
					$appd['prva'][$key][$res]+=1;
					break;
					case 1:
					$appd['isit'][$key][$res]+=1;
					break;
					case 2:
					$appd['men'][$key][$res]+=1;
					break;
					case 3:
					$appd['om'][$key][$res]+=1;
					break;
					case 4:
					$appd['uk'][$key][$res]+=1;
					break;
				}
				switch (ceil($entry->surveyentry->semester/2)) {
					case 2:
					$appd['druga'][$key][$res]+=1;
					break;
					case 3:
					$appd['treca'][$key][$res]+=1;
					break;
					case 4:
					$appd['cetvrta'][$key][$res]+=1;
					break;
				}
				// }
				// array_push($appd[$newsid][$key], $res);
			}
		}
		return $appd;

			//return View::make('surveys.results')->with('data',$appd);

		// }
	}

//kreira prazne nizove koji ce sadrzati konkretan rezultat - za predmet, smer, ukupno...
	private function createEmptyQuestionArray($num){
		switch ($num) {
			case 6:
			return array(1=>0,2=>0);
			break;
			case 7:
			return array(1=>0,2=>0,3=>0,4=>0);
			break;
			case 9:
			return array(0=>0,1=>0,2=>0,3=>0,4=>0,5=>0);
			break;
			default:
			return array(1=>0,2=>0,3=>0,4=>0,5=>0);
			break;
		}
	}

	private function createAnswer($title,$classes=' '){
		return array(
			'name'=>$title,
			'classes'=>explode(',', $classes),
			1=>$this->createEmptyQuestionArray(1),
			2=>$this->createEmptyQuestionArray(2),
			3=>$this->createEmptyQuestionArray(3),
			4=>$this->createEmptyQuestionArray(4),
			5=>$this->createEmptyQuestionArray(5),
			6=>$this->createEmptyQuestionArray(6),
			7=>$this->createEmptyQuestionArray(7),
			8=>$this->createEmptyQuestionArray(8),
			9=>$this->createEmptyQuestionArray(9),
			10=>$this->createEmptyQuestionArray(10));
	}



	public function prepareEntryResults($id){
		$entries = Ps_surveyentry::all();
		$subjectsAll = $this->getSubjectsByYearDepartment();
		foreach ($entries as $key => $entry) {
			$subjectsOld = $subjectsAll['dep'.$entry->department.'sem'.$entry->semester];
			//$subjects = array_merge(array(), $subjectsAll['dep'.$entry->department.'sem'.$entry->semester]);
			$subjects = $this->array_copy($subjectsOld);

			$entry->surveyevals = $this->mergeSubjectArrays($subjects,$entry->surveyevals);	
			
			
		}
		return $entries;

	}

//clones objects of array
	public function array_copy($arr) {
		$newArray = array();
		foreach($arr as $key => $value) {
			if(is_array($value)) $newArray[$key] = array_copy($value);
			else if(is_object($value)) $newArray[$key] = clone $value;
			else $newArray[$key] = $value;
		}
		return $newArray;
	}

	public function mergeSubjectArrays($subjects,$evals){
		foreach ($subjects as $key1 => $item1) {
			$item1->entered = false;
			foreach ($evals as $key2 => $item2) {
				
				if($item1->id==$item2->subject_id){
					$item1->entered = true;
				}

			}
		}
		return $subjects;
	}

	public function getSubjectsByYearDepartment(){
		$result = array();
		$result['dep0sem1'] = Ps_survey::getSubjects(1,0);
		$result['dep1sem3'] = Ps_survey::getSubjects(3,1);
		$result['dep2sem3'] = Ps_survey::getSubjects(3,2);
		$result['dep3sem3'] = Ps_survey::getSubjects(3,3);
		$result['dep4sem3'] = Ps_survey::getSubjects(3,4);
		$result['dep1sem5'] = Ps_survey::getSubjects(5,1);
		$result['dep2sem5'] = Ps_survey::getSubjects(5,2);
		$result['dep3sem5'] = Ps_survey::getSubjects(5,3);
		$result['dep4sem5'] = Ps_survey::getSubjects(5,4);
		$result['dep1sem7'] = Ps_survey::getSubjects(7,1);
		$result['dep2sem7'] = Ps_survey::getSubjects(7,2);
		$result['dep3sem7'] = Ps_survey::getSubjects(7,3);
		$result['dep4sem7'] = Ps_survey::getSubjects(7,4);
		return $result;
	}

	public function prepareEntriesByDate($id){
		$entries = Ps_surveyentry::all();
		$result = array();
		foreach ($entries as $key => $entry) {
			$datekey = date('d.m.Y',strtotime($entry->created_at));
			if(!isset($result[$datekey])){
				$result[$datekey] = array(
					'isit'=>0,
					'men'=>0,
					'om'=>0,
					'uk'=>0,
					'prva'=>0,
					'druga'=>0,
					'treca'=>0,
					'cetvrta'=>0,
					'ukupno'=>0);
			}
			switch ($entry->department) {
				case 0:
				$result[$datekey]['prva']+=1;
				break;
				case 1:
				$result[$datekey]['isit']+=1;
				break;
				case 2:
				$result[$datekey]['men']+=1;
				break;
				case 3:
				$result[$datekey]['om']+=1;
				break;
				case 4:
				$result[$datekey]['uk']+=1;
				break;
			}
			switch (ceil($entry->semester/2)) {
				case 2:
				$result[$datekey]['druga']+=1;
				break;
				case 3:
				$result[$datekey]['treca']+=1;
				break;
				case 4:
				$result[$datekey]['cetvrta']+=1;
				break;
			}
			$result[$datekey]['ukupno']+=1;
		}
		return $result;
	}














	public function questionSchema(){
		return array(
			1=>array(
				'question'=>'Profesori/Asistenti dolaze na predavanja pripremljeni i na taj način olakšava učenje',
				'answers'=>array(
					0=>'',
					1=>'Uopšte se ne slažem',
					2=>'Delimično se ne slažem',
					3=>'Niti se slažem, niti se ne slažem',
					4=>'Delimično se slažem',
					5=>'U potpunosti se slažem',
					)
				),
			2=>array(
				'question'=>'Profesori/Asistenti podstiču studente da razmišljaju i učestvuju u diskusiji',
				'answers'=>array(
					0=>'',
					1=>'Uopšte se ne slažem',
					2=>'Delimično se ne slažem',
					3=>'Niti se slažem, niti se ne slažem',
					4=>'Delimično se slažem',
					5=>'U potpunosti se slažem',
					)
				),
			3=>array(
				'question'=>'Na vežbe i predavanja:',
				'answers'=>array(
					0=>'',
					1=>'Nisam dolazio (0-20% posete)',
					2=>'Uglavnom nisam dolazio (21-40% posete)',
					3=>'Povremeno sam dolazio (41- 60% posete)',
					4=>'Uglavnom sam dolazio (61- 80% posete)',
					5=>'Skoro uvek sam dolazio (81- 100% posete)',
					)
				),
			4=>array(
				'question'=>'Koliko si dana spremao ispit:',
				'answers'=>array(
					0=>'',
					1=>'Nisam spremao',
					2=>'Do nedelju dana',
					3=>'Do 2 nedelje',
					4=>' Mesec dana',
					5=>'Više od mesec dana',
					)
				),
			5=>array(
				'question'=>'Dolazio/la sam na predavanja pripremeljen/a i učestvovao/la sam u diskusiji',
				'answers'=>array(
					0=>'',
					1=>'Nisam dolazio na predavanja',
					2=>'Dolazio sam na predavanja, nepripremljen, nisam učestvovao u diskusiji',
					3=>'Dolazio sam na predavanja, znao sam o materiji, ali nisam učestvovao u diskusiji',
					4=>'Dolazio sam na predavanja nepripremljen, ali sam učestvovao u diskusiji',
					5=>'Dolazio sam na predavanja pripremljen i učestvovao sam u diskusiji',
					)
				),
			6=>array(
				'question'=>'Pripremao sam ovaj ispit da bih:',
				'answers'=>array(
					0=>'',
					1=>'Samo da bih položio ispit',
					2=>'Jer me interesuje tematika, ali naravno i da bih položio ispit',
					3=>'',
					4=>'',
					5=>'',
					)
				),
			7=>array(
				'question'=>'Profesori/asistenti se odnose prema studentu:',
				'answers'=>array(
					0=>'',
					1=>'Svi profesori se ophode prema studentima sa poštovanjem i uvažavanjem',
					2=>'Većina profesora se ophodi prema studentima sa poštovanjem i uvažavanjem',
					3=>'Većina profesora ulazi u konflikte sa studentima',
					4=>'Svi profesori ulaze u konflikte sa studentima',
					5=>'',
					)
				),
			8=>array(
				'question'=>'Profesorima je stalo do studenata i aktivno se zalažu za studentski standard',
				'answers'=>array(
					0=>'',
					1=>'Uopšte se ne slažem',
					2=>'Delimično se ne slažem',
					3=>'Niti se slažem, niti se ne slažem',
					4=>'Delimično se slažem',
					5=>'U potpunosti se slažem',
					)
				),
			9=>array(
				'question'=>'Ocena sa kolokvijuma i ispita oslikava moje znanje',
				'answers'=>array(
					0=>'Nisam položio',
					1=>'Uopšte se ne slažem',
					2=>'Delimično se ne slažem',
					3=>'Niti se slažem, niti se ne slažem',
					4=>'Delimično se slažem',
					5=>'U potpunosti se slažem',
					)
				),
			10=>array(
				'question'=>'Profesori/asistenti imaju jasne i jednake kriterijume za ocenjivanje i dosledno ih primenjuju',
				'answers'=>array(
					0=>'',
					1=>'Uopšte se ne slažem',
					2=>'Delimično se ne slažem',
					3=>'Niti se slažem, niti se ne slažem',
					4=>'Delimično se slažem',
					5=>'U potpunosti se slažem',
					)
				),
			);
}


}