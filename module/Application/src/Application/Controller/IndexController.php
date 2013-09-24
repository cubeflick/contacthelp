<?php

namespace Application\Controller;

use Zend\Validator\NotEmpty;

use Zend\Filter\Null;

use Application\Entity\CompanyListing;
use Application\Form\listing;
use Application\Form\rating;
use Zend\Mvc\Controller\AbstractActionController,
Zend\View\Model\ViewModel,
Category\Form\CategoryFormValidator,
Zend\Mvc\Controller\ActionController,
Doctrine\ORM\EntityManager,
Zend\Paginator;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator as ZPaginator;
use Doctrine\ORM\Query\ResultSetMapping;

class IndexController extends AbstractActionController
{
	
	
	
	protected $em;
	
	public function getEntityManager()
	{
		if (null === $this->em) {
			$this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
		}
		return $this->em;
	}
	
	
	
	
    public function indexAction()
    {
    	
//     	$this->categoryAction();
        return new ViewModel();
        
    }
    
    public function aboutAction()
    {
    	
    	return new ViewModel();
    }
    public function newsAction()
    {
    	 
    	return new ViewModel();
    }
    public function contactAction()
    {
    	 
    	return new ViewModel();
    }
    
    public function categoryAction()
    
    {
    	
//     	//echo "<pre>";
//     	//print_r($this->params());
//     	$catname = $this->params('catname', null);
//     	echo $catname;
//     	echo "Inside cat";
//     	die;
    	
    	$request = $this->getRequest();
    	$repository = $this->getEntityManager()->getRepository('Category\Entity\Category');
        $em = $this->getEntityManager();
    	
    	$form = new Listing();
    	
    	
    	$listing = new CompanyListing();
    	$listing->populate($request->getPost());
		
    	$resultset = $repository->findBy(array('parentId'=>null));
//     	 echo '<pre>';
//     	 print_r($resultset);
//     	 die;
    	
    	return new ViewModel(array(
    			
    			'category' => $resultset
    	));
    	
    }
    
    public function subcategoryAction()
    
    {
    	$this->categoryAction();
    	    	$catname = $this->params('catname', null);
//     	    	echo $catname;
//     	    	die;
    	
    	$request = $this->getRequest();
    	$repository = $this->getEntityManager()->getRepository('Category\Entity\Category');
    	$em = $this->getEntityManager();
    	 
    	$form = new Listing();
    	$query = $em->createQuery("select cat.id from Category\Entity\Category cat where cat.cname = '$catname' ");
			$subcats = $query->getResult();
// 			echo '<pre>';
//     		echo $subcats[0]['id'];
//     		die;

			$subcat = $subcats[0];
			$id = $subcat['id'];
// 			echo $id;
// 			die;
			
    	$listing = new CompanyListing();
    	$listing->populate($request->getPost());
    
    	$resultset = $repository->findBy(array('parentId'=> $id));
    	//     	 echo '<pre>';
    	//     	 print_r($resultset);
    	//     	 die;
    	 
    	return new ViewModel(array(
    			'category' => $catname,
    			'subcategory' => $resultset
    	));
    	 
    }
    
    public function companylistAction()
    
    {
    	$catname = $this->params('catname', null);
    	$subcatname = $this->params('subcatname', null);
//     	echo $catname;
//     	echo $subcatname;
//     	die;
    	
    	
    	$request = $this->getRequest();
    	$repository = $this->getEntityManager()->getRepository('Application\Entity\CompanyListing');
    	$em = $this->getEntityManager();
    
    	$form = new Listing();
    	$query = $em->createQuery("select list,list._id,list._listingName,list._subCategoryOne,list._subCategoryTwo,list._subCategoryThree,
					list._companyUrl,list._department,list._phoneNumber,list._stepToReach,list._customerServiceLink,
					list._customerSupportEmail,list._operationHours,list._description,list._additionalNote,list._userName,
					list._userEmail,list._status from Application\Entity\CompanyListing list where list._subCategoryOne = '$subcatname'
    			or list._subCategoryTwo = '$subcatname' or list._subCategoryThree = '$subcatname' ");
    	$records = $query->getResult();
    
//     	foreach($records as $result)
//     	{
//     	                echo '<pre>';
//     					print_r($result);
//     					echo $result['_id'];
//     	}
//     					die;
    	$listing = new CompanyListing();
    	$listing->populate($request->getPost());
    
    	$resultset = $repository->findBy(array('_subCategoryTwo'=>$subcatname));
//     	    	 echo '<pre>';
//     	    	 print_r($resultset);
//     	    	 die;
    
    return new ViewModel(array(
    			'category' => $catname,
    			'subcategory' => $subcatname,
    			'records' => $records,
    			'company' => $resultset
    	));
    
    }
    
    public function companyrecordAction()
    
    {
    	$catname = $this->params('catname', null);
    	$subcatname = $this->params('subcatname', null);
    	$listingname = $this->params('listingname', null);
//     	    	echo $catname;
//     	    	echo $subcatname;
//     	    	echo $listingname;
//     	    	die;
    	$request = $this->getRequest();
    	$repository = $this->getEntityManager()->getRepository('Application\Entity\CompanyListing');
    	$em = $this->getEntityManager();
    	
    	$form = new Listing();
    	
    	
    	$listing = new CompanyListing();
    	$listing->populate($request->getPost());
    	
    	$resultset = $repository->findBy(array('_listingName'=>$listingname));
//     	    	 echo '<pre>';
//     	    	 print_r($resultset);
//  				 die;
    	
    	return new ViewModel(array(
    			
    			'result' => $resultset
    	));
    }
    
    
    
    public function managelistingAction()
    
    {
    	$this->layout('layout/layout_admin');
		$repository = $this->getEntityManager()->getRepository('Application\Entity\CompanyListing');
		$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
		$em = $this->getEntityManager();
		
		
		if($authService->hasIdentity())
		{
			$loggedInUser = $authService->getIdentity();
			$this->layout()->loggedInUser = $loggedInUser;
		
			
			$query = $em->createQuery('select list,list._id,list._listingName,list._subCategoryOne,list._subCategoryTwo,list._subCategoryThree,
					list._companyUrl,list._department,list._phoneNumber,list._stepToReach,list._customerServiceLink,
					list._customerSupportEmail,list._operationHours,list._description,list._additionalNote,list._userName,
					list._userEmail,list._status from Application\Entity\CompanyListing list');
			
// 						print_r($query);
// 						die;
			$messages = $this->flashMessenger()->getMessages();
			$paginator = new ZPaginator(
					new DoctrinePaginator(new ORMPaginator($query))
			);
			// 			echo "<pre>";
			// 			print_r($this->params());
			// 			die;
			$paginator->setCurrentPageNumber($this->params('page',1))
			->setItemCountPerPage(10);
			
			
			return new ViewModel(array(
					'messages' => $messages,
					'paginator' => $paginator
			));
			
		}
		else
		{
			return $this->redirect()->toRoute('login');
			
		}
    	
    	
    }
    
    
    public function manageAction()
    
    {
    	$this->layout('layout/layout_admin');
    	$repository = $this->getEntityManager()->getRepository('Application\Entity\CompanyListing');
		$authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
		$em = $this->getEntityManager();
	
		$listingname = $this->params('listingname', null);
		$id = $this->params('id', null);
// 		echo $id;
// 		die;

		$request = $this->getRequest();
		if($request->isPost())
		{
			$status = $request->getPost('status',null);
			$id = $request->getPost('id',null);
			
			if($status == 1){
			$query = $em->createQuery("UPDATE Application\Entity\CompanyListing list SET list._status=0 WHERE list._id= '$id'");
			$query->getResult();
			$this->flashMessenger()->addMessage('Listing is rejected successfully');
			return $this->redirect()->toRoute('manage_listing');
		     }
		     if($status == 0){
		     	$query = $em->createQuery("UPDATE Application\Entity\CompanyListing list SET list._status=1 WHERE list._id= '$id'");
		     	$query->getResult();
		     	$this->flashMessenger()->addMessage('Listing is approved successfully');
		     	return $this->redirect()->toRoute('manage_listing');
		     }
		     
		   
//  		    echo $status;
// 			echo $id;
// 			die;
		}
		
		
		
		if($authService->hasIdentity())
		{
			
			$loggedInUser = $authService->getIdentity();
			$this->layout()->loggedInUser = $loggedInUser;
				
			$messages = $this->flashMessenger()->getMessages();
				
			$resultset = $repository->findBy(array('_id'=> $id));
			$record = $resultset[0];
// 									echo "<pre>";
// 									print_r($resultset);
// 									echo $record->getListingId();
// 									die;

			return array('record' => $record);
					
			
		}
		else
		{
			return $this->redirect()->toRoute('login');
				
		}
		
		
    }
    
    
    public function listingAction()
    
    {
    	$request = $this->getRequest();
    	$repository = $this->getEntityManager()->getRepository('Category\Entity\Category');
        $em = $this->getEntityManager();
    	
    	$form = new Listing();
    	
    	
    	$listing = new CompanyListing();
    	$listing->populate($request->getPost());
		
    	$resultset = $repository->findBy(array('parentId'=>null));

    	
       $arrayFinal = array();
    	foreach ($resultset as $key => $category)
    	{
    		$subCatArray = $repository->findBy(array('parentId'=>$category->getId()));
    		$arrayFinal[$category->getName()] = $subCatArray;
    	}
    	
//     	echo'<pre>';
//     	print_r($arrayFinal);
//     foreach ($arrayFinal as $key => $cat)
//     {
//     	echo $key;
//     	foreach($cat as $key1 => $subcat)
//     	{
//     		echo $subcat->getName();
//     	}
//     }
//    	die;
    
    
    	
   
    	
    	
    	
    	
    	if($request->isPost())
    	{
//     		$formValidator = new CategoryFormValidator();
//     		$form->setInputFilter($formValidator->getInputFilter());
    		$form->setData($request->getPost());
    		
    		 
    		
    		
//     		if($form->isValid()){
//     			{
    				

    				$em->persist($listing);
    				$em->flush();
    				$this->flashMessenger()->addMessage('Listing added successfully','success');
    				echo "Data Saved";
    				
//    				return $this->redirect()->toRoute('managecategory');
//     			}
//     		}
    				
    				
    	}
    	
    	//die;
    	 
    	return array('form' => $form, 'category' => $arrayFinal);
//     	return new ViewModel(array(
    			 
//     			'category' => $arrayOptions
//     	));
    	
    }
    
    public function ratingAction()
    
    {
    	
    	$request = $this->getRequest();
    	$repository = $this->getEntityManager()->getRepository('Category\Entity\Category');
    	$em = $this->getEntityManager();
    	 
    	$form = new Rating();
    	 
    	 
    	$listing = new CompanyListing();
    	$listing->populate($request->getPost());
    	
    	$resultset = $repository->findBy(array('parentId'=>null));
    	
    	 
    	$arrayFinal = array();
    	foreach ($resultset as $key => $category)
    	{
    		$subCatArray = $repository->findBy(array('parentId'=>$category->getId()));
    		$arrayFinal[$category->getName()] = $subCatArray;
    	}
    	 
    
    	if($request->isPost())
    	{
    		//     		$formValidator = new CategoryFormValidator();
    		//     		$form->setInputFilter($formValidator->getInputFilter());
    		$form->setData($request->getPost());
    	
    		$em->persist($listing);
    		$em->flush();
    		$this->flashMessenger()->addMessage('Listing added successfully','success');
    		echo "Data Saved";
    	
    	}
    	return array('form' => $form, 'category' => $arrayFinal);
    	  
    }
    
    
    
    public function searchlistingAction(){

    	
    	$request = $this->getRequest();
    	$q = $request->getQuery('term', null);
    	$em = $this->getEntityManager();
    	
    	$query = $em->createQuery('select list,list._id,list._listingName,list._subCategoryOne,list._subCategoryTwo,list._subCategoryThree,
					list._companyUrl,list._department,list._phoneNumber,list._stepToReach,list._customerServiceLink,
					list._customerSupportEmail,list._operationHours,list._description,list._additionalNote,list._userName,
					list._userEmail,list._status from Application\Entity\CompanyListing list where list._status=1');
    		 
    	$records = $query->getResult();
//     	echo '<pre>';
//     	print_r($records);
// 		die;

    	$items = array();
		foreach ($records as $record )
		{
			//to find the category of the specific listing
			$em = $this->getEntityManager();
		    $subcat =  $record['_subCategoryOne'];
			$query = $em->createQuery("select cat.parentId, cat.id from Category\Entity\Category cat where cat.cname = '$subcat' ");
			$cat = $query->getResult();
			if($cat)
			{
			$catId = $cat[0]['parentId'];
// 			    		echo '<pre>';
// 						print_r($cat[0]);
// 						echo $cat[0]['parentId'];
// 			    		die;
			
			
		$query2 = $em->createQuery("select cat.cname, cat.id from Category\Entity\Category cat where cat.id = '$catId' ");
			$catName = $query2->getResult();
			if($catName)
			{
			$catName = $catName[0]['cname'];
// 			echo $catName;
// 			die;	
// 						echo '<pre>';
// 						print_r($catName[0]);
// 						echo $catName[0]['cname'];
// 			    		die;
			
			
			
			$url = "/directory/";
			$url .= str_replace(' ','_',strtolower($catName));
			$url .= "/";
			$url .= str_replace(' ','_',strtolower($record['_subCategoryOne']));
			$url .= "/";
			$url .=  str_replace(' ','_',strtolower($record['_listingName']));
// 			echo $url;
// 			echo '<br>';
			$items[$record['_listingName']] = $url;
			}
			}
			
		}
		
// 		echo'<pre>';
// 		print_r($items);
//     	die;

//     	$items = array(
//     			"Great Bittern"=>"Botaurus stellaris",
//     			"Little Grebe"=>"Tachybaptus ruficollis",
//     			"Black-necked Grebe"=>"Podiceps nigricollis",
//     			"Little Bittern"=>"Ixobrychus minutus",
//     			"Black-crowned Night Heron"=>"Nycticorax nycticorax",
//     			"Purple Heron"=>"Ardea purpurea",
//     			"White Stork"=>"Ciconia ciconia",
//     			"Spoonbill"=>"Platalea leucorodia",
//     			"Red-crested Pochard"=>"Netta rufina",
//     			"Common Eider"=>"Somateria mollissima",
//     			"Red Kite"=>"Milvus milvus",
//     			"Hen Harrier"=>"Circus cyaneus",
//     			"Montagu`s Harrier"=>"Circus pygargus",
//     			"Black Grouse"=>"Tetrao tetrix",
//     			"Grey Partridge"=>"Perdix perdix",
//     			"Spotted Crake"=>"Porzana porzana",
//     			"Corncrake"=>"Crex crex",
//     			"Common Crane"=>"Grus grus",
//     			"Avocet"=>"Recurvirostra avosetta",
//     			"Stone Curlew"=>"Burhinus oedicnemus",
//     			"Common Ringed Plover"=>"Charadrius hiaticula",
//     			"Kentish Plover"=>"Charadrius alexandrinus",
//     			"Ruff"=>"Philomachus pugnax",
//     			"Common Snipe"=>"Gallinago gallinago",
//     			"Black-tailed Godwit"=>"Limosa limosa",
//     			"Common Redshank"=>"Tringa totanus",
//     			"Sandwich Tern"=>"Sterna sandvicensis",
//     			"Common Tern"=>"Sterna hirundo",
//     			"Arctic Tern"=>"Sterna paradisaea",
//     			"Little Tern"=>"Sternula albifrons",
//     			"Black Tern"=>"Chlidonias niger",
//     			"Barn Owl"=>"Tyto alba",
//     			"Little Owl"=>"Athene noctua",
//     			"Short-eared Owl"=>"Asio flammeus",
//     			"European Nightjar"=>"Caprimulgus europaeus",
//     			"Common Kingfisher"=>"Alcedo atthis",
//     			"Eurasian Hoopoe"=>"Upupa epops",
//     			"Eurasian Wryneck"=>"Jynx torquilla",
//     			"European Green Woodpecker"=>"Picus viridis",
//     			"Crested Lark"=>"Galerida cristata",
//     			"White-headed Duck"=>"Oxyura leucocephala",
//     			"Pale-bellied Brent Goose"=>"Branta hrota",
//     			"Tawny Pipit"=>"Anthus campestris",
//     			"Whinchat"=>"Saxicola rubetra",
//     			"European Stonechat"=>"Saxicola rubicola",
//     			"Northern Wheatear"=>"Oenanthe oenanthe",
//     			"Savi`s Warbler"=>"Locustella luscinioides",
//     			"Sedge Warbler"=>"Acrocephalus schoenobaenus",
//     			"Great Reed Warbler"=>"Acrocephalus arundinaceus",
//     			"Bearded Reedling"=>"Panurus biarmicus",
//     			"Red-backed Shrike"=>"Lanius collurio",
//     			"Great Grey Shrike"=>"Lanius excubitor",
//     			"Woodchat Shrike"=>"Lanius senator",
//     			"Common Raven"=>"Corvus corax",
//     			"Yellowhammer"=>"Emberiza citrinella",
//     			"Ortolan Bunting"=>"Emberiza hortulana",
//     			"Corn Bunting"=>"Emberiza calandra",
//     			"Great Cormorant"=>"Phalacrocorax carbo",
//     			"Hawfinch"=>"Coccothraustes coccothraustes",
//     			"Common Shelduck"=>"Tadorna tadorna",
//     			"Bluethroat"=>"Luscinia svecica",
//     			"Grey Heron"=>"Ardea cinerea",
//     			"Barn Swallow"=>"Hirundo rustica",
//     			"Hooded Crow"=>"Corvus cornix",
//     			"Dunlin"=>"Calidris alpina",
//     			"Eurasian Pied Flycatcher"=>"Ficedula hypoleuca",
//     			"Eurasian Nuthatch"=>"Sitta europaea",
//     			"Short-toed Tree Creeper"=>"Certhia brachydactyla",
//     			"Wood Lark"=>"Lullula arborea",
//     			"Tree Pipit"=>"Anthus trivialis",
//     			"Eurasian Hobby"=>"Falco subbuteo",
//     			"Marsh Warbler"=>"Acrocephalus palustris",
//     			"Wood Sandpiper"=>"Tringa glareola",
//     			"Tawny Owl"=>"Strix aluco",
//     			"Lesser Whitethroat"=>"Sylvia curruca",
//     			"Barnacle Goose"=>"Branta leucopsis",
//     			"Common Goldeneye"=>"Bucephala clangula",
//     			"Western Marsh Harrier"=>"Circus aeruginosus",
//     			"Common Buzzard"=>"Buteo buteo",
//     			"Sanderling"=>"Calidris alba",
//     			"Little Gull"=>"Larus minutus",
//     			"Eurasian Magpie"=>"Pica pica",
//     			"Willow Warbler"=>"Phylloscopus trochilus",
//     			"Wood Warbler"=>"Phylloscopus sibilatrix",
//     			"Great Crested Grebe"=>"Podiceps cristatus",
//     			"Eurasian Jay"=>"Garrulus glandarius",
//     			"Common Redstart"=>"Phoenicurus phoenicurus",
//     			"Blue-headed Wagtail"=>"Motacilla flava",
//     			"Common Swift"=>"Apus apus",
//     			"Marsh Tit"=>"Poecile palustris",
//     			"Goldcrest"=>"Regulus regulus",
//     			"European Golden Plover"=>"Pluvialis apricaria",
//     			"Eurasian Bullfinch"=>"Pyrrhula pyrrhula",
//     			"Common Whitethroat"=>"Sylvia communis",
//     			"Meadow Pipit"=>"Anthus pratensis",
//     			"Greylag Goose"=>"Anser anser",
//     			"Spotted Flycatcher"=>"Muscicapa striata",
//     			"European Greenfinch"=>"Carduelis chloris",
//     			"Common Greenshank"=>"Tringa nebularia",
//     			"Great Spotted Woodpecker"=>"Dendrocopos major",
//     			"Greater Canada Goose"=>"Branta canadensis",
//     			"Mistle Thrush"=>"Turdus viscivorus",
//     			"Great Black-backed Gull"=>"Larus marinus",
//     			"Goosander"=>"Mergus merganser",
//     			"Great Egret"=>"Casmerodius albus",
//     			"Northern Goshawk"=>"Accipiter gentilis",
//     			"Dunnock"=>"Prunella modularis",
//     			"Stock Dove"=>"Columba oenas",
//     			"Common Wood Pigeon"=>"Columba palumbus",
//     			"Eurasian Woodcock"=>"Scolopax rusticola",
//     			"House Sparrow"=>"Passer domesticus",
//     			"Common House Martin"=>"Delichon urbicum",
//     			"Red Knot"=>"Calidris canutus",
//     			"Western Jackdaw"=>"Corvus monedula",
//     			"Brambling"=>"Fringilla montifringilla",
//     			"Northern Lapwing"=>"Vanellus vanellus",
//     			"European Reed Warbler"=>"Acrocephalus scirpaceus",
//     			"Lesser Black-backed Gull"=>"Larus fuscus",
//     			"Little Egret"=>"Egretta garzetta",
//     			"Little Stint"=>"Calidris minuta",
//     			"Common Linnet"=>"Carduelis cannabina",
//     			"Mute Swan"=>"Cygnus olor",
//     			"Common Cuckoo"=>"Cuculus canorus",
//     			"Black-headed Gull"=>"Larus ridibundus",
//     			"Greater White-fronted Goose"=>"Anser albifrons",
//     			"Great Tit"=>"Parus major",
//     			"Redwing"=>"Turdus iliacus",
//     			"Gadwall"=>"Anas strepera",
//     			"Fieldfare"=>"Turdus pilaris",
//     			"Tufted Duck"=>"Aythya fuligula",
//     			"Crested Tit"=>"Lophophanes cristatus",
//     			"Willow Tit"=>"Poecile montanus",
//     			"Eurasian Coot"=>"Fulica atra",
//     			"Common Blackbird"=>"Turdus merula",
//     			"Smew"=>"Mergus albellus",
//     			"Common Sandpiper"=>"Actitis hypoleucos",
//     			"Sand Martin"=>"Riparia riparia",
//     			"Purple Sandpiper"=>"Calidris maritima",
//     			"Northern Pintail"=>"Anas acuta",
//     			"Blue Tit"=>"Cyanistes caeruleus",
//     			"European Goldfinch"=>"Carduelis carduelis",
//     			"Eurasian Whimbrel"=>"Numenius phaeopus",
//     			"Common Reed Bunting"=>"Emberiza schoeniclus",
//     			"Eurasian Tree Sparrow"=>"Passer montanus",
//     			"Rook"=>"Corvus frugilegus",
//     			"European Robin"=>"Erithacus rubecula",
//     			"Bar-tailed Godwit"=>"Limosa lapponica",
//     			"Dark-bellied Brent Goose"=>"Branta bernicla",
//     			"Eurasian Oystercatcher"=>"Haematopus ostralegus",
//     			"Eurasian Siskin"=>"Carduelis spinus",
//     			"Northern Shoveler"=>"Anas clypeata",
//     			"Eurasian Wigeon"=>"Anas penelope",
//     			"Eurasian Sparrow Hawk"=>"Accipiter nisus",
//     			"Icterine Warbler"=>"Hippolais icterina",
//     			"Common Starling"=>"Sturnus vulgaris",
//     			"Long-tailed Tit"=>"Aegithalos caudatus",
//     			"Ruddy Turnstone"=>"Arenaria interpres",
//     			"Mew Gull"=>"Larus canus",
//     			"Common Pochard"=>"Aythya ferina",
//     			"Common Chiffchaff"=>"Phylloscopus collybita",
//     			"Greater Scaup"=>"Aythya marila",
//     			"Common Kestrel"=>"Falco tinnunculus",
//     			"Garden Warbler"=>"Sylvia borin",
//     			"Eurasian Collared Dove"=>"Streptopelia decaocto",
//     			"Eurasian Skylark"=>"Alauda arvensis",
//     			"Common Chaffinch"=>"Fringilla coelebs",
//     			"Common Moorhen"=>"Gallinula chloropus",
//     			"Water Pipit"=>"Anthus spinoletta",
//     			"Mallard"=>"Anas platyrhynchos",
//     			"Winter Wren"=>"Troglodytes troglodytes",
//     			"Common Teal"=>"Anas crecca",
//     			"Green Sandpiper"=>"Tringa ochropus",
//     			"White Wagtail"=>"Motacilla alba",
//     			"Eurasian Curlew"=>"Numenius arquata",
//     			"Song Thrush"=>"Turdus philomelos",
//     			"European Herring Gull"=>"Larus argentatus",
//     			"Grey Plover"=>"Pluvialis squatarola",
//     			"Carrion Crow"=>"Corvus corone",
//     			"Coal Tit"=>"Periparus ater",
//     			"Spotted Redshank"=>"Tringa erythropus",
//     			"Blackcap"=>"Sylvia atricapilla",
//     			"Egyptian Vulture"=>"Neophron percnopterus",
//     			"Razorbill"=>"Alca torda",
//     			"Alpine Swift"=>"Apus melba",
//     			"Long-legged Buzzard"=>"Buteo rufinus",
//     			"Audouin`s Gull"=>"Larus audouinii",
//     			"Balearic Shearwater"=>"Puffinus mauretanicus",
//     			"Upland Sandpiper"=>"Bartramia longicauda",
//     			"Greater Spotted Eagle"=>"Aquila clanga",
//     			"Ring Ouzel"=>"Turdus torquatus",
//     			"Yellow-browed Warbler"=>"Phylloscopus inornatus",
//     			"Blue Rock Thrush"=>"Monticola solitarius",
//     			"Buff-breasted Sandpiper"=>"Tryngites subruficollis",
//     			"Jack Snipe"=>"Lymnocryptes minimus",
//     			"White-rumped Sandpiper"=>"Calidris fuscicollis",
//     			"Ruddy Shelduck"=>"Tadorna ferruginea",
//     			"Cetti's Warbler"=>"Cettia cetti",
//     			"Citrine Wagtail"=>"Motacilla citreola",
//     			"Roseate Tern"=>"Sterna dougallii",
//     			"Black-legged Kittiwake"=>"Rissa tridactyla",
//     			"Pygmy Cormorant"=>"Phalacrocorax pygmeus",
//     			"Booted Eagle"=>"Aquila pennata",
//     			"Lesser White-fronted Goose"=>"Anser erythropus",
//     			"Little Bunting"=>"Emberiza pusilla",
//     			"Eleonora's Falcon"=>"Falco eleonorae",
//     			"European Serin"=>"Serinus serinus",
//     			"Twite"=>"Carduelis flavirostris",
//     			"Yellow-legged Gull"=>"Larus michahellis",
//     			"Gyr Falcon"=>"Falco rusticolus",
//     			"Greenish Warbler"=>"Phylloscopus trochiloides",
//     			"Red-necked Phalarope"=>"Phalaropus lobatus",
//     			"Mealy Redpoll"=>"Carduelis flammea",
//     			"Glaucous Gull"=>"Larus hyperboreus",
//     			"Great Skua"=>"Stercorarius skua",
//     			"Great Bustard"=>"Otis tarda",
//     			"Velvet Scoter"=>"Melanitta fusca",
//     			"Pine Grosbeak"=>"Pinicola enucleator",
//     			"House Crow"=>"Corvus splendens",
//     			"Hume`s Leaf Warbler"=>"Phylloscopus humei",
//     			"Great Northern Loon"=>"Gavia immer",
//     			"Long-tailed Duck"=>"Clangula hyemalis",
//     			"Lapland Longspur"=>"Calcarius lapponicus",
//     			"Northern Gannet"=>"Morus bassanus",
//     			"Eastern Imperial Eagle"=>"Aquila heliaca",
//     			"Little Auk"=>"Alle alle",
//     			"Lesser Spotted Woodpecker"=>"Dendrocopos minor",
//     			"Iceland Gull"=>"Larus glaucoides",
//     			"Parasitic Jaeger"=>"Stercorarius parasiticus",
//     			"Bewick`s Swan"=>"Cygnus bewickii",
//     			"Little Bustard"=>"Tetrax tetrax",
//     			"Little Crake"=>"Porzana parva",
//     			"Baillon`s Crake"=>"Porzana pusilla",
//     			"Long-tailed Jaeger"=>"Stercorarius longicaudus",
//     			"King Eider"=>"Somateria spectabilis",
//     			"Greater Short-toed Lark"=>"Calandrella brachydactyla",
//     			"Houbara Bustard"=>"Chlamydotis undulata",
//     			"Curlew Sandpiper"=>"Calidris ferruginea",
//     			"Common Crossbill"=>"Loxia curvirostra",
//     			"European Shag"=>"Phalacrocorax aristotelis",
//     			"Horned Grebe"=>"Podiceps auritus",
//     			"Common Quail"=>"Coturnix coturnix",
//     			"Bearded Vulture"=>"Gypaetus barbatus",
//     			"Lanner Falcon"=>"Falco biarmicus",
//     			"Middle Spotted Woodpecker"=>"Dendrocopos medius",
//     			"Pomarine Jaeger"=>"Stercorarius pomarinus",
//     			"Red-breasted Merganser"=>"Mergus serrator",
//     			"Eurasian Black Vulture"=>"Aegypius monachus",
//     			"Eurasian Dotterel"=>"Charadrius morinellus",
//     			"Common Nightingale"=>"Luscinia megarhynchos",
//     			"Northern willow warbler"=>"Phylloscopus trochilus acredula",
//     			"Manx Shearwater"=>"Puffinus puffinus",
//     			"Northern Fulmar"=>"Fulmarus glacialis",
//     			"Eurasian Eagle Owl"=>"Bubo bubo",
//     			"Orphean Warbler"=>"Sylvia hortensis",
//     			"Melodious Warbler"=>"Hippolais polyglotta",
//     			"Pallas's Leaf Warbler"=>"Phylloscopus proregulus",
//     			"Atlantic Puffin"=>"Fratercula arctica",
//     			"Black-throated Loon"=>"Gavia arctica",
//     			"Bohemian Waxwing"=>"Bombycilla garrulus",
//     			"Marsh Sandpiper"=>"Tringa stagnatilis",
//     			"Great Snipe"=>"Gallinago media",
//     			"Squacco Heron"=>"Ardeola ralloides",
//     			"Long-eared Owl"=>"Asio otus",
//     			"Caspian Tern"=>"Hydroprogne caspia",
//     			"Red-breasted Goose"=>"Branta ruficollis",
//     			"Red-throated Loon"=>"Gavia stellata",
//     			"Common Rosefinch"=>"Carpodacus erythrinus",
//     			"Red-footed Falcon"=>"Falco vespertinus",
//     			"Ross's Goose"=>"Anser rossii",
//     			"Red Phalarope"=>"Phalaropus fulicarius",
//     			"Pied Wagtail"=>"Motacilla yarrellii",
//     			"Rose-coloured Starling"=>"Sturnus roseus",
//     			"Rough-legged Buzzard"=>"Buteo lagopus",
//     			"Saker Falcon"=>"Falco cherrug",
//     			"European Roller"=>"Coracias garrulus",
//     			"Short-toed Eagle"=>"Circaetus gallicus",
//     			"Peregrine Falcon"=>"Falco peregrinus",
//     			"Merlin"=>"Falco columbarius",
//     			"Snow Goose"=>"Anser caerulescens",
//     			"Snowy Owl"=>"Bubo scandiacus",
//     			"Snow Bunting"=>"Plectrophenax nivalis",
//     			"Common Grasshopper Warbler"=>"Locustella naevia",
//     			"Golden Eagle"=>"Aquila chrysaetos",
//     			"Black-winged Stilt"=>"Himantopus himantopus",
//     			"Steppe Eagle"=>"Aquila nipalensis",
//     			"Pallid Harrier"=>"Circus macrourus",
//     			"European Storm-petrel"=>"Hydrobates pelagicus",
//     			"Horned Lark"=>"Eremophila alpestris",
//     			"Eurasian Treecreeper"=>"Certhia familiaris",
//     			"Taiga Bean Goose"=>"Anser fabalis",
//     			"Temminck`s Stint"=>"Calidris temminckii",
//     			"Terek Sandpiper"=>"Xenus cinereus",
//     			"Tundra Bean Goose"=>"Anser serrirostris",
//     			"European Turtle Dove"=>"Streptopelia turtur",
//     			"Leach`s Storm-petrel"=>"Oceanodroma leucorhoa",
//     			"Eurasian Griffon Vulture"=>"Gyps fulvus",
//     			"Paddyfield Warbler"=>"Acrocephalus agricola",
//     			"Osprey"=>"Pandion haliaetus",
//     			"Firecrest"=>"Regulus ignicapilla",
//     			"Water Rail"=>"Rallus aquaticus",
//     			"European Honey Buzzard"=>"Pernis apivorus",
//     			"Eurasian Golden Oriole"=>"Oriolus oriolus",
//     			"Whooper Swan"=>"Cygnus cygnus",
//     			"Two-barred Crossbill"=>"Loxia leucoptera",
//     			"White-tailed Eagle"=>"Haliaeetus albicilla",
//     			"Atlantic Murre"=>"Uria aalge",
//     			"Garganey"=>"Anas querquedula",
//     			"Black Redstart"=>"Phoenicurus ochruros",
//     			"Common Scoter"=>"Melanitta nigra",
//     			"Rock Pipit"=>"Anthus petrosus",
//     			"Lesser Spotted Eagle"=>"Aquila pomarina",
//     			"Cattle Egret"=>"Bubulcus ibis",
//     			"White-winged Black Tern"=>"Chlidonias leucopterus",
//     			"Black Stork"=>"Ciconia nigra",
//     			"Mediterranean Gull"=>"Larus melanocephalus",
//     			"Black Kite"=>"Milvus migrans",
//     			"Yellow Wagtail"=>"Motacilla flavissima",
//     			"Red-necked Grebe"=>"Podiceps grisegena",
//     			"Gull-billed Tern"=>"Gelochelidon nilotica",
//     			"Pectoral Sandpiper"=>"Calidris melanotos",
//     			"Barred Warbler"=>"Sylvia nisoria",
//     			"Red-throated Pipit"=>"Anthus cervinus",
//     			"Grey Wagtail"=>"Motacilla cinerea",
//     			"Richard`s Pipit"=>"Anthus richardi",
//     			"Black Woodpecker"=>"Dryocopus martius",
//     			"Little Ringed Plover"=>"Charadrius dubius",
//     			"Whiskered Tern"=>"Chlidonias hybrida",
//     			"Lesser Redpoll"=>"Carduelis cabaret",
//     			"Pallas' Bunting"=>"Emberiza pallasi",
//     			"Ferruginous Duck"=>"Aythya nyroca",
//     			"Whistling Swan"=>"Cygnus columbianus",
//     			"Black Brant"=>"Branta nigricans",
//     			"Marbled Teal"=>"Marmaronetta angustirostris",
//     			"Canvasback"=>"Aythya valisineria",
//     			"Redhead"=>"Aythya americana",
//     			"Lesser Scaup"=>"Aythya affinis",
//     			"Steller`s Eider"=>"Polysticta stelleri",
//     			"Spectacled Eider"=>"Somateria fischeri",
//     			"Harlequin Duck"=>"Histronicus histrionicus",
//     			"Black Scoter"=>"Melanitta americana",
//     			"Surf Scoter"=>"Melanitta perspicillata",
//     			"Barrow`s Goldeneye"=>"Bucephala islandica",
//     			"Falcated Duck"=>"Anas falcata",
//     			"American Wigeon"=>"Anas americana",
//     			"Blue-winged Teal"=>"Anas discors",
//     			"American Black Duck"=>"Anas rubripes",
//     			"Baikal Teal"=>"Anas formosa",
//     			"Green-Winged Teal"=>"Anas carolinensis",
//     			"Hazel Grouse"=>"Bonasa bonasia",
//     			"Rock Partridge"=>"Alectoris graeca",
//     			"Red-legged Partridge"=>"Alectoris rufa",
//     			"Yellow-billed Loon"=>"Gavia adamsii",
//     			"Cory`s Shearwater"=>"Calonectris borealis",
//     			"Madeiran Storm-Petrel"=>"Oceanodroma castro",
//     			"Great White Pelican"=>"Pelecanus onocrotalus",
//     			"Dalmatian Pelican"=>"Pelecanus crispus",
//     			"American Bittern"=>"Botaurus lentiginosus",
//     			"Glossy Ibis"=>"Plegadis falcinellus",
//     			"Spanish Imperial Eagle"=>"Aquila adalberti",
//     			"Lesser Kestrel"=>"Falco naumanni",
//     			"Houbara Bustard"=>"Chlamydotis undulata",
//     			"Crab-Plover"=>"Dromas ardeola",
//     			"Cream-coloured Courser"=>"Cursorius cursor",
//     			"Collared Pratincole"=>"Glareola pratincola",
//     			"Black-winged Pratincole"=>"Glareola nordmanni",
//     			"Killdeer"=>"Charadrius vociferus",
//     			"Lesser Sand Plover"=>"Charadrius mongolus",
//     			"Greater Sand Plover"=>"Charadrius leschenaultii",
//     			"Caspian Plover"=>"Charadrius asiaticus",
//     			"American Golden Plover"=>"Pluvialis dominica",
//     			"Pacific Golden Plover"=>"Pluvialis fulva",
//     			"Sharp-tailed Sandpiper"=>"Calidris acuminata",
//     			"Broad-billed Sandpiper"=>"Limicola falcinellus",
//     			"Spoon-Billed Sandpiper"=>"Eurynorhynchus pygmaeus",
//     			"Short-Billed Dowitcher"=>"Limnodromus griseus",
//     			"Long-billed Dowitcher"=>"Limnodromus scolopaceus",
//     			"Hudsonian Godwit"=>"Limosa haemastica",
//     			"Little Curlew"=>"Numenius minutus",
//     			"Lesser Yellowlegs"=>"Tringa flavipes",
//     			"Wilson`s Phalarope"=>"Phalaropus tricolor",
//     			"Pallas`s Gull"=>"Larus ichthyaetus",
//     			"Laughing Gull"=>"Larus atricilla",
//     			"Franklin`s Gull"=>"Larus pipixcan",
//     			"Bonaparte`s Gull"=>"Larus philadelphia",
//     			"Ring-billed Gull"=>"Larus delawarensis",
//     			"American Herring Gull"=>"Larus smithsonianus",
//     			"Caspian Gull"=>"Larus cachinnans",
//     			"Ivory Gull"=>"Pagophila eburnea",
//     			"Royal Tern"=>"Sterna maxima",
//     			"Brünnich`s Murre"=>"Uria lomvia",
//     			"Crested Auklet"=>"Aethia cristatella",
//     			"Parakeet Auklet"=>"Cyclorrhynchus psittacula",
//     			"Tufted Puffin"=>"Lunda cirrhata",
//     			"Laughing Dove"=>"Streptopelia senegalensis",
//     			"Great Spotted Cuckoo"=>"Clamator glandarius",
//     			"Great Grey Owl"=>"Strix nebulosa",
//     			"Tengmalm`s Owl"=>"Aegolius funereus",
//     			"Red-Necked Nightjar"=>"Caprimulgus ruficollis",
//     			"Chimney Swift"=>"Chaetura pelagica",
//     			"Green Bea-Eater"=>"Merops orientalis",
//     			"Grey-headed Woodpecker"=>"Picus canus",
//     			"Lesser Short-Toed Lark"=>"Calandrella rufescens",
//     			"Eurasian Crag Martin"=>"Hirundo rupestris",
//     			"Red-rumped Swallow"=>"Cecropis daurica",
//     			"Blyth`s Pipit"=>"Anthus godlewskii",
//     			"Pechora Pipit"=>"Anthus gustavi",
//     			"Grey-headed Wagtail"=>"Motacilla thunbergi",
//     			"Yellow-Headed Wagtail"=>"Motacilla lutea",
//     			"White-throated Dipper"=>"Cinclus cinclus",
//     			"Rufous-Tailed Scrub Robin"=>"Cercotrichas galactotes",
//     			"Thrush Nightingale"=>"Luscinia luscinia",
//     			"White-throated Robin"=>"Irania gutturalis",
//     			"Caspian Stonechat"=>"Saxicola maura variegata",
//     			"Western Black-eared Wheatear"=>"Oenanthe hispanica",
//     			"Rufous-tailed Rock Thrush"=>"Monticola saxatilis",
//     			"Red-throated Thrush/Black-throated"=>"Turdus ruficollis",
//     			"American Robin"=>"Turdus migratorius",
//     			"Zitting Cisticola"=>"Cisticola juncidis",
//     			"Lanceolated Warbler"=>"Locustella lanceolata",
//     			"River Warbler"=>"Locustella fluviatilis",
//     			"Blyth`s Reed Warbler"=>"Acrocephalus dumetorum",
//     			"Caspian Reed Warbler"=>"Acrocephalus fuscus",
//     			"Aquatic Warbler"=>"Acrocephalus paludicola",
//     			"Booted Warbler"=>"Acrocephalus caligatus",
//     			"Marmora's Warbler"=>"Sylvia sarda",
//     			"Dartford Warbler"=>"Sylvia undata",
//     			"Subalpine Warbler"=>"Sylvia cantillans",
//     			"Ménétries's Warbler"=>"Sylvia mystacea",
//     			"Rüppel's Warbler"=>"Sylvia rueppelli",
//     			"Asian Desert Warbler"=>"Sylvia nana",
//     			"Western Orphean Warbler"=>"Sylvia hortensis hortensis",
//     			"Arctic Warbler"=>"Phylloscopus borealis",
//     			"Radde`s Warbler"=>"Phylloscopus schwarzi",
//     			"Western Bonelli`s Warbler"=>"Phylloscopus bonelli",
//     			"Red-breasted Flycatcher"=>"Ficedula parva",
//     			"Eurasian Penduline Tit"=>"Remiz pendulinus",
//     			"Daurian Shrike"=>"Lanius isabellinus",
//     			"Long-Tailed Shrike"=>"Lanius schach",
//     			"Lesser Grey Shrike"=>"Lanius minor",
//     			"Southern Grey Shrike"=>"Lanius meridionalis",
//     			"Masked Shrike"=>"Lanius nubicus",
//     			"Spotted Nutcracker"=>"Nucifraga caryocatactes",
//     			"Daurian Jackdaw"=>"Corvus dauuricus",
//     			"Purple-Backed Starling"=>"Sturnus sturninus",
//     			"Red-Fronted Serin"=>"Serinus pusillus",
//     			"Arctic Redpoll"=>"Carduelis hornemanni",
//     			"Scottish Crossbill"=>"Loxia scotica",
//     			"Parrot Crossbill"=>"Loxia pytyopsittacus",
//     			"Black-faced Bunting"=>"Emberiza spodocephala",
//     			"Pink-footed Goose"=>"Anser brachyrhynchus",
//     			"Black-winged Kite"=>"Elanus caeruleus",
//     			"European Bee-eater"=>"Merops apiaster",
//     			"Sabine`s Gull"=>"Larus sabini",
//     			"Sooty Shearwater"=>"Puffinus griseus",
//     			"Lesser Canada Goose"=>"Branta hutchinsii",
//     			"Ring-necked Duck"=>"Aythya collaris",
//     			"Greater Flamingo"=>"Phoenicopterus roseus",
//     			"Iberian Chiffchaff"=>"Phylloscopus ibericus",
//     			"Ashy-headed Wagtail"=>"Motacilla cinereocapilla",
//     			"Stilt Sandpiper"=>"Calidris himantopus",
//     			"Siberian Stonechat"=>"Saxicola maurus",
//     			"Greater Yellowlegs"=>"Tringa melanoleuca",
//     			"Forster`s Tern"=>"Sterna forsteri",
//     			"Dusky Warbler"=>"Phylloscopus fuscatus",
//     			"Cirl Bunting"=>"Emberiza cirlus",
//     			"Olive-backed Pipit"=>"Anthus hodgsoni",
//     			"Sociable Lapwing"=>"Vanellus gregarius",
//     			"Spotted Sandpiper"=>"Actitis macularius",
//     			"Baird`s Sandpiper"=>"Calidris bairdii",
//     			"Rustic Bunting"=>"Emberiza rustica",
//     			"Yellow-browed Bunting"=>"Emberiza chrysophrys",
//     			"Great Shearwater"=>"Puffinus gravis",
//     			"Bonelli`s Eagle"=>"Aquila fasciata",
//     			"Calandra Lark"=>"Melanocorypha calandra",
//     			"Sardinian Warbler"=>"Sylvia melanocephala",
//     			"Ross's Gull"=>"Larus roseus",
//     			"Yellow-Breasted Bunting"=>"Emberiza aureola",
//     			"Pine Bunting"=>"Emberiza leucocephalos",
//     			"Black Guillemot"=>"Cepphus grylle",
//     			"Pied-billed Grebe"=>"Podilymbus podiceps",
//     			"Soft-plumaged Petrel"=>"Pterodroma mollis",
//     			"Bulwer's Petrel"=>"Bulweria bulwerii",
//     			"White-Faced Storm-Petrel"=>"Pelagodroma marina",
//     			"Pallas’s Fish Eagle"=>"Haliaeetus leucoryphus",
//     			"Sandhill Crane"=>"Grus canadensis",
//     			"Macqueen’s Bustard"=>"Chlamydotis macqueenii",
//     			"White-tailed Lapwing"=>"Vanellus leucurus",
//     			"Great Knot"=>"Calidris tenuirostris",
//     			"Semipalmated Sandpiper"=>"Calidris pusilla",
//     			"Red-necked Stint"=>"Calidris ruficollis",
//     			"Slender-billed Curlew"=>"Numenius tenuirostris",
//     			"Bridled Tern"=>"Onychoprion anaethetus",
//     			"Pallas’s Sandgrouse"=>"Syrrhaptes paradoxus",
//     			"European Scops Owl"=>"Otus scops",
//     			"Northern Hawk Owl"=>"Surnia ulula",
//     			"White-Throated Needletail"=>"Hirundapus caudacutus",
//     			"Belted Kingfisher"=>"Ceryle alcyon",
//     			"Blue-cheeked Bee-eater"=>"Merops persicus",
//     			"Black-headed Wagtail"=>"Motacilla feldegg",
//     			"Northern Mockingbird"=>"Mimus polyglottos",
//     			"Alpine Accentor"=>"Prunella collaris",
//     			"Red-flanked Bluetail"=>"Tarsiger cyanurus",
//     			"Isabelline Wheatear"=>"Oenanthe isabellina",
//     			"Pied Wheatear"=>"Oenanthe pleschanka",
//     			"Eastern Black-eared Wheatear"=>"Oenanthe melanoleuca",
//     			"Desert Wheatear"=>"Oenanthe deserti",
//     			"White`s Thrush"=>"Zoothera aurea",
//     			"Siberian Thrush"=>"Zoothera sibirica",
//     			"Eyebrowed Thrush"=>"Turdus obscurus",
//     			"Dusky Thrush"=>"Turdus eunomus",
//     			"Black-throated Thrush"=>"Turdus atrogularis",
//     			"Pallas`s Grasshopper Warbler"=>"Locustella certhiola",
//     			"Spectacled Warbler"=>"Sylvia conspicillata",
//     			"Two-barred Warbler"=>"Phylloscopus plumbeitarsus",
//     			"Eastern Bonelli’s Warbler"=>"Phylloscopus orientalis",
//     			"Collared Flycatcher"=>"Ficedula albicollis",
//     			"Wallcreeper"=>"Tichodroma muraria",
//     			"Turkestan Shrike"=>"Lanius phoenicuroides",
//     			"Steppe Grey Shrike"=>"Lanius pallidirostris",
//     			"Spanish Sparrow"=>"Passer hispaniolensis",
//     			"Red-eyed Vireo"=>"Vireo olivaceus",
//     			"Myrtle Warbler"=>"Dendroica coronata",
//     			"White-crowned Sparrow"=>"Zonotrichia leucophrys",
//     			"White-throated Sparrow"=>"Zonotrichia albicollis",
//     			"Cretzschmar`s Bunting"=>"Emberiza caesia",
//     			"Chestnut Bunting"=>"Emberiza rutila",
//     			"Red-headed Bunting"=>"Emberiza bruniceps",
//     			"Black-headed Bunting"=>"Emberiza melanocephala",
//     			"Indigo Bunting"=>"Passerina cyanea",
//     			"Balearic Woodchat Shrike"=>"Lanius senator badius",
//     			"Demoiselle Crane"=>"Grus virgo",
//     			"Chough"=>"Pyrrhocorax pyrrhocorax",
//     			"Red-Billed Chough"=>"Pyrrhocorax graculus",
//     			"Elegant Tern"=>"Sterna elegans",
//     			"Chukar"=>"Alectoris chukar",
//     			"Yellow-Billed Cuckoo"=>"Coccyzus americanus",
//     			"American Sandwich Tern"=>"Sterna sandvicensis acuflavida",
//     			"Olive-Tree Warbler"=>"Hippolais olivetorum",
//     			"Eastern Olivaceous Warbler"=>"Acrocephalus pallidus",
//     			"Indian Cormorant"=>"Phalacrocorax fuscicollis",
//     			"Spur-Winged Lapwing"=>"Vanellus spinosus",
//     			"Yelkouan Shearwater"=>"Puffinus yelkouan",
//     			"Trumpeter Finch"=>"Bucanetes githagineus",
//     			"Red Grouse"=>"Lagopus scoticus",
//     			"Rock Ptarmigan"=>"Lagopus mutus",
//     			"Long-Tailed Cormorant"=>"Phalacrocorax africanus",
//     			"Double-crested Cormorant"=>"Phalacrocorax auritus",
//     			"Magnificent Frigatebird"=>"Fregata magnificens",
//     			"Naumann's Thrush"=>"Turdus naumanni",
//     			"Oriental Pratincole"=>"Glareola maldivarum",
//     			"Bufflehead"=>"Bucephala albeola",
//     			"Snowfinch"=>"Montifrigilla nivalis",
//     			"Ural owl"=>"Strix uralensis",
//     			"Spanish Wagtail"=>"Motacilla iberiae",
//     			"Song Sparrow"=>"Melospiza melodia",
//     			"Rock Bunting"=>"Emberiza cia",
//     			"Siberian Rubythroat"=>"Luscinia calliope",
//     			"Pallid Swift"=>"Apus pallidus",
//     			"Eurasian Pygmy Owl"=>"Glaucidium passerinum",
//     			"Madeira Little Shearwater"=>"Puffinus baroli",
//     			"House Finch"=>"Carpodacus mexicanus",
//     			"Green Heron"=>"Butorides virescens",
//     			"Solitary Sandpiper"=>"Tringa solitaria",
//     			"Heuglin's Gull"=>"Larus heuglini"
//     	);
    	
//     	print_r($items);
//        	die;
    	
    	$result = array();
    	foreach ($items as $key=>$value) {
    		if (strpos(strtolower($key), $q) !== false) {
    			array_push($result, array("id"=>$value, "label"=>$key, "value" => strip_tags($key)));
    		}
    		if (count($result) > 11)
    			break;
    	}
    	
    	// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
    	echo json_encode($result);
    	exit;
    }
}
