function burycard() {
	//高さ揃える用
	var hList=new Array();
	//各ボックスの高さを取得して配列に保存しておく
	$("div.card1").each(function(idx){
		//高さを追加					   
		hList[idx]=$(this).height();		 
	});
	var maxH=Math.max.apply(null,hList);
	$("div.card1").css({"height":maxH+"px"});
	
	//カード左揃え用
	var $grid = $('.wrap'),   
    emptyCells = [],
    i;
	for (i = 0; i < $grid.find('.card1').length; i++) {
    emptyCells.push($('<div>', { class: 'card1 is-empty' }));
	}
	$grid.append(emptyCells);
}
