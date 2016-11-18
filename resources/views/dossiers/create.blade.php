@extends('layouts.row')
@section('panel-heading')
<h1>Gestion des dossiers</h1>
@endsection
@section('navLevel2')
@include('dossiers.navLevel2')
@endsection
@section('body')
<form role="form" method="POST" action="{{ url('/dossiers/create') }}">
	{{ csrf_field() }}
	<div class="form-group{{ $errors->has('prenom') ? ' has-error' : '' }}">
		<label for="prenom" class=" control-label">Prénom</label>
		<input id="prenom" type="text" class="form-control" name="prenom" value="{{ old('prenom') }}" autofocus>
		@if ($errors->has('prenom'))
		<span class="help-block">
			<strong>{{ $errors->first('prenom') }}</strong>
		</span>
		@endif
	</div>
	<div class="form-group{{ $errors->has('nom') ? ' has-error' : '' }}">
		<label for="nom" class=" control-label">Nom</label>
		<input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}" autofocus>

		@if ($errors->has('nom'))
		<span class="help-block">
			<strong>{{ $errors->first('nom') }}</strong>
		</span>
		@endif
	</div>
	<div class="form-group{{ $errors->has('sexe') ? ' has-error' : '' }}">
		<label for="sexe" class="control-label">Sexe du jeune</label>
		<select class="form-control" name="sexe">
			<option value="" selected>Veuillez choisir</option>
			<option value=2 @if(old('sexe')==2)
			selected
			@endif>
			Féminin
		</option>
		<option value=1 @if(old('sexe')==1)
		selected
		@endif>
		Masculin
	</option>
</select>
@if ($errors->has('sexe'))
<span class="help-block">
	<strong>{{ $errors->first('sexe') }}</strong>
</span>
@endif
</div>
<div class="form-group{{ $errors->has('no_doss_chus') ? ' has-error' : '' }}">
	<label for="no_doss_chus" class=" control-label"># dossier CHUS</label>
	<input id="no_doss_chus" type="text" class="form-control" name="no_doss_chus" value="{{ old('no_doss_chus') }}" autofocus>
	@if ($errors->has('no_doss_chus'))
	<span class="help-block">
		<strong>{{ $errors->first('no_doss_chus') }}</strong>
	</span>
	@endif
</div>
<div class="form-group{{ $errors->has('date_naiss') ? ' has-error' : '' }}">
	<label for="date_naiss" class=" control-label">Date de naissance</label>
	<input id="date_naiss" type="text" class="form-control datepicker" name="date_naiss" value="{{ old('date_naiss') }}" autofocus>
	@if ($errors->has('date_naiss'))
	<span class="help-block">
		<strong>{{ $errors->first('date_naiss') }}</strong>
	</span>
	@endif
</div>
<div class="form-group{{ $errors->has('premiere_seance') ? ' has-error' : '' }}">
	<label for="premiere_seance" class=" control-label">Date prévue de la première séance de traitement</label>
	<input id="premiere_seance" type="date" class="form-control" name="premiere_seance" value="{{ old('premiere_seance') }}" autofocus>
	@if ($errors->has('premiere_seance'))
	<span class="help-block">
		<strong>{{ $errors->first('premiere_seance') }}</strong>
	</span>
	@endif
</div>
<div class="form-group{{ $errors->has('bilan_final') ? ' has-error' : '' }}">
	<label for="bilan_final" class=" control-label">Date prévue du bilan final</label>
	<input id="bilan_final" type="date" class="form-control" name="bilan_final" value="{{ old('bilan_final') }}" autofocus>
	@if ($errors->has('bilan_final'))
	<span class="help-block">
		<strong>{{ $errors->first('bilan_final') }}</strong>
	</span>
	@endif
</div>
<div class="form-group">
	<label><input type="checkbox" name="exclu" value="1" 
	@if(old('exclu')==1)
	checked
	@endif 
	> Exclure de l'étude</label>
</div>						
<button type="submit" class="btn btn-primary pull-right">
	Ajouter
</button>
</form>
@endsection
@section('script')
<script type="text/javascript">

/*! modernizr 3.3.1 (Custom Build) | MIT *
 * https://modernizr.com/download/?-inputtypes-setclasses !*/
!function(e,t,n){function a(e,t){return typeof e===t}function s(){var e,t,n,s,i,o,c;for(var u in r)if(r.hasOwnProperty(u)){if(e=[],t=r[u],t.name&&(e.push(t.name.toLowerCase()),t.options&&t.options.aliases&&t.options.aliases.length))for(n=0;n<t.options.aliases.length;n++)e.push(t.options.aliases[n].toLowerCase());for(s=a(t.fn,"function")?t.fn():t.fn,i=0;i<e.length;i++)o=e[i],c=o.split("."),1===c.length?Modernizr[c[0]]=s:(!Modernizr[c[0]]||Modernizr[c[0]]instanceof Boolean||(Modernizr[c[0]]=new Boolean(Modernizr[c[0]])),Modernizr[c[0]][c[1]]=s),l.push((s?"":"no-")+c.join("-"))}}function i(e){var t=u.className,n=Modernizr._config.classPrefix||"";if(f&&(t=t.baseVal),Modernizr._config.enableJSClass){var a=new RegExp("(^|\\s)"+n+"no-js(\\s|$)");t=t.replace(a,"$1"+n+"js$2")}Modernizr._config.enableClasses&&(t+=" "+n+e.join(" "+n),f?u.className.baseVal=t:u.className=t)}function o(){return"function"!=typeof t.createElement?t.createElement(arguments[0]):f?t.createElementNS.call(t,"http://www.w3.org/2000/svg",arguments[0]):t.createElement.apply(t,arguments)}var l=[],r=[],c={_version:"3.3.1",_config:{classPrefix:"",enableClasses:!0,enableJSClass:!0,usePrefixes:!0},_q:[],on:function(e,t){var n=this;setTimeout(function(){t(n[e])},0)},addTest:function(e,t,n){r.push({name:e,fn:t,options:n})},addAsyncTest:function(e){r.push({name:null,fn:e})}},Modernizr=function(){};Modernizr.prototype=c,Modernizr=new Modernizr;var u=t.documentElement,f="svg"===u.nodeName.toLowerCase(),p=o("input"),d="search tel url email datetime date month week time datetime-local number range color".split(" "),m={};Modernizr.inputtypes=function(e){for(var a,s,i,o=e.length,l="1)",r=0;o>r;r++)p.setAttribute("type",a=e[r]),i="text"!==p.type&&"style"in p,i&&(p.value=l,p.style.cssText="position:absolute;visibility:hidden;",/^range$/.test(a)&&p.style.WebkitAppearance!==n?(u.appendChild(p),s=t.defaultView,i=s.getComputedStyle&&"textfield"!==s.getComputedStyle(p,null).WebkitAppearance&&0!==p.offsetHeight,u.removeChild(p)):/^(search|tel)$/.test(a)||(i=/^(url|email)$/.test(a)?p.checkValidity&&p.checkValidity()===!1:p.value!=l)),m[e[r]]=!!i;return m}(d),s(),i(l),delete c.addTest,delete c.addAsyncTest;for(var h=0;h<Modernizr._q.length;h++)Modernizr._q[h]();e.Modernizr=Modernizr}(window,document);

if (Modernizr.inputtypes.date) {
  alert('supported!!');
} else {
  alert('not supported!!');
}



	$( "#gestion_dossiers" ).addClass( "active" );
	$( "#create" ).addClass( "active" );

$('.datepicker').datepicker({
	dateFormat:"dd/mm/yyyy"
});
</script>
@endsection
