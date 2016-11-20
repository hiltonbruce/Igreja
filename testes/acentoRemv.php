<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>jQuery Remove Uppercase Accents Test Suite</title>
	<link rel="stylesheet" href="http://code.jquery.com/qunit/qunit-1.12.0.css">
	<script src="http://code.jquery.com/qunit/qunit-1.12.0.js"></script>
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="jquery.remove-upcase-accents.js"></script>
</head>
<body>
	<div id="qunit"></div>
	<div id="qunit-fixture">
		<div lang="el">
			<span>ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ</span>
			<input type="text" value="ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ">

			<span class="remove-accents">ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ</span>
			<span style="text-transform: uppercase;">ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ</span>
			<span style="font-variant: small-caps;">ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ</span>
			<span style="text-transform: uppercase;" class="no-remove-accents">ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ</span>

			<input type="text" style="text-transform: uppercase;" value="ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ">
			<textarea style="text-transform: uppercase;">ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ</textarea>
			<input type="submit" style="text-transform: uppercase;" value="ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ">
			<button style="text-transform: uppercase;">ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ</button>

			<input type="text" class="remove-accents" value="ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ">
			<textarea class="remove-accents">ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ</textarea>

			<div style="text-transform: uppercase;">
				<span>ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ</span>
			</div>

			<div class="remove-accents">
				<span>ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ</span>
				<span class="no-remove-accents">ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ</span>
				<input type="text" value="ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ">
				<textarea>ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ</textarea>
				<input type="submit" value="ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ">
				<button>ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ</button>
			</div>
		</div>
	</div>
	<script>
		module( "greek" );
		test( "remove accents from element inner text nodes", function() {
			equal( $( "#qunit-fixture div:lang(el) span" ).first().removeAcc().get( 0 ).innerHTML, 'ΑΕΗΙΟΥΩιΙΥαεηιυιυουω', "accents removed from element inner text nodes" );
		});
		test( "remove accents from element value attribute", function() {
			equal( $( "#qunit-fixture div:lang(el) input" ).first().removeAcc().get( 0 ).value, 'ΑΕΗΙΟΥΩιΙΥαεηιυιυουω', "accents removed from element value attribute" );
		});
		test( "remove accents from elements with remove-accents class", function() {
			equal( $( "#qunit-fixture div:lang(el) span" ).get( 1 ).innerHTML, 'ΑΕΗΙΟΥΩιΙΥαεηιυιυουω', "accents have been removed from elements with remove-accents class" );
			equal( $( "#qunit-fixture div:lang(el) input.remove-accents" ).get( 0 ).value, 'ΑΕΗΙΟΥΩιΙΥαεηιυιυουω', "accents have been removed from input elements with remove-accents class" );
			equal( $( "#qunit-fixture div:lang(el) textarea.remove-accents" ).get( 0 ).value, 'ΑΕΗΙΟΥΩιΙΥαεηιυιυουω', "accents have been removed from textarea elements with remove-accents class" );
		});
		test( "remove accents from elements with uppercase text transformation", function() {
			equal( $( "#qunit-fixture div:lang(el) span" ).get( 2 ).innerHTML, 'ΑΕΗΙΟΥΩιΙΥαεηιυιυουω', "accents have been removed from elements with uppercase text transformation" );
		});
		test( "remove accents from elements with small-caps font variant", function() {
			equal( $( "#qunit-fixture div:lang(el) span" ).get( 3 ).innerHTML, 'ΑΕΗΙΟΥΩιΙΥαεηιυιυουω', "accents have been removed from elements with small-caps font variant" );
		});
		test( "do not remove accents from elements with no-remove-accents class", function() {
			equal( $( "#qunit-fixture div:lang(el) span.no-remove-accents" ).get( 0 ).innerHTML, 'ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ', "accents have not been removed from elements with no-remove-accents class" );
			equal( $( "#qunit-fixture div:lang(el) div.remove-accents span.no-remove-accents" ).get( 0 ).innerHTML, 'ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ', "accents have not been removed from elements with no-remove-accents class inheriting transformation conditions" );
		});
		test( "remove accents from elements inheriting transformation conditions", function() {
			equal( $( "#qunit-fixture div:lang(el) div[style] span" ).get( 0 ).innerHTML, 'ΑΕΗΙΟΥΩιΙΥαεηιυιυουω', "accents have been removed from elements inheriting transformation conditions" );
			equal( $( "#qunit-fixture div:lang(el) div.remove-accents span" ).get( 0 ).innerHTML, 'ΑΕΗΙΟΥΩιΙΥαεηιυιυουω', "accents have been removed from elements inheriting remove-accents class" );
		});
		test( "do not remove accents from input elements", function() {
			equal( $( "#qunit-fixture div:lang(el) input" ).get( 0 ).value, 'ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ', "accents have not been removed from input elements" );
			equal( $( "#qunit-fixture div:lang(el) div.remove-accents input" ).get( 0 ).value, 'ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ', "accents have not been removed from input elements inheriting transformation conditions" );
		});
		test( "do not remove accents from textarea elements", function() {
			equal( $( "#qunit-fixture div:lang(el) textarea" ).get( 0 ).value, 'ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ', "accents have not been removed from textarea elements" );
			equal( $( "#qunit-fixture div:lang(el) div.remove-accents textarea" ).get( 0 ).value, 'ΆΈΉΊΌΎΏΐΪΫάέήίΰϊϋόύώ', "accents have not been removed from textarea elements inheriting transformation conditions" );
		});
		test( "remove accents from submit input elements", function() {
			equal( $( "#qunit-fixture div:lang(el) input[type=submit]" ).get( 0 ).value, 'ΑΕΗΙΟΥΩιΙΥαεηιυιυουω', "accents have been removed from submit input elements" );
			equal( $( "#qunit-fixture div:lang(el) div.remove-accents input[type=submit]" ).get( 0 ).value, 'ΑΕΗΙΟΥΩιΙΥαεηιυιυουω', "accents have been removed from submit input elements inheriting transformation conditions" );
		});
		test( "remove accents from button elements", function() {
			equal( $( "#qunit-fixture div:lang(el) button" ).get( 0 ).innerHTML, 'ΑΕΗΙΟΥΩιΙΥαεηιυιυουω', "accents have been removed from button elements" );
			equal( $( "#qunit-fixture div:lang(el) div.remove-accents button" ).get( 0 ).innerHTML, 'ΑΕΗΙΟΥΩιΙΥαεηιυιυουω', "accents have been removed from button elements inheriting transformation conditions" );
		});
	</script>
</body>
</html>
