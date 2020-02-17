<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * This work is licensed under a Creative Commons Attribution 4.0 International Public License.
 * 		http://creativecommons.org/licenses/by/4.0/
 *
 * */

namespace dvc\module;
use strings;    ?>

<div class="row">
	<div class="col pt-4">
		<ul class="list-unstyled mt-4">
			<li><a href="<?= strings::url( $this->route) ?>"><h6>Index</h6></a></li>
			<li><a href="<?= strings::url( $this->route) ?>/changes">changes</a></li>

		</ul>

	</div>

</div>
