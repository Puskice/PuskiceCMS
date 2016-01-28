@section('footer')
<div class="col-md-12">
	<div class="row">
		<div class="col-md-7">
			<a href="{{Request::root()}}/stranica/puskice">{{__("О Пушкицама")}}</a>
			<a href="{{Request::root()}}/stranica/uslovi-koriscenja">{{__("Услови коришћења")}}</a>
			<a href="{{Request::root()}}/stranica/vremeplov">{{__("Времеплов")}}</a>
			<a href="{{Request::root()}}/stranica/kontakt">{{__("Контакт")}}</a>
			<a href="{{Request::root()}}/novi-clanovi">{{__("Постани члан!")}}</a>
		</div>
		<div class="col-md-5 pull-right">
			<a href="#" class="copyright">{{__("Пушкице - верзија 8.0 &copy; ".date("Y", strtotime("now"))." - powered by Puskice CMS")}}</a>
		</div>
	</div>
</div>
@stop