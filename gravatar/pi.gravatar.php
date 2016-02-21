<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require 'vendor/autoload.php';

use forxer\Gravatar\Gravatar as FGravatar;

/*
Copyright (C) 2004 - 2016 EllisLab, Inc.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
ELLISLAB, INC. BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

Except as contained in this notice, the name of EllisLab, Inc. shall not be
used in advertising or otherwise to promote the sale, use or other dealings
in this Software without prior written authorization from EllisLab, Inc.
*/

/**
 * Gravatar Class
 *
 * @package			ExpressionEngine
 * @category		Plugin
 * @author			EllisLab
 * @copyright		Copyright (c) 2016, EllisLab, Inc.
 * @link			https://github.com/EllisLab/Gravatar
 */
class Gravatar {

	/*
	 * @var  string  The plugin return data, since we use the constructor for our lifting
	 */
	public $return_data;

	/*
	 * @var  string  Email address identifier
	 */
	private $email;

	/*
	 * @var  int  Default image size in pixels
	 */
	private $size = 80;

	/*
	 * @var  string  Default image URL
	 */
	private $default = 'mm';

	/*
	 * @var  string  Maximum allowed rating
	 */
	private $rating = 'pg';

	/*
	 * @var  string  File type extension
	 */
	private $extension = 'png';

	/*
	 * @var  bool  https
	 */
	private $https = TRUE;

	/*
	 * @var  bool  Force Default Image
	 */
	private $force_default = FALSE;

	/*
	 * @var  string  Base URL for Adorable Avatars, http://avatars.adorable.io/
	 */
	private $adorable_base_url = 'https://api.adorable.io/avatars/';

	/**
	 * Constructor
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct($str = '')
	{
		if ( ! $this->setOptionsFromParameters())
		{
			ee()->TMPL->log_item('<b>Gravatar:</b> Aborted!');
			return FALSE;
		}

		$gravatar = FGravatar::image(
			$this->email,
			$this->size,
			$this->default,
			$this->rating,
			$this->extension,
			$this->https,
			$this->force_default
		);

		// bug in current forxer\Gravatar
		// Full URLs given as the default image are double encoded
		if (strncasecmp($this->default, 'http', 4) === 0)
		{
			$url = parse_url($gravatar);
			parse_str(html_entity_decode($url['query']), $default_url);
			$default_url['d'] = rawurldecode($default_url['d']);
			$gravatar = $url['scheme'].'://'.$url['host'].$url['path'].'?'.http_build_query($default_url);
		}

		$this->return_data = $gravatar;
	}

	// ------------------------------------------------------------------------

	/**
	 * Set Options from Parameters
	 *
	 * @return bool  FALSE when required parameters are not present
	 */
	private function setOptionsFromParameters()
	{
		// order here is imporant!

		// Email
		if ( ! $this->email = ee()->TMPL->fetch_param('email'))
		{
			ee()->TMPL->log_item('<b>Gravatar:</b> Email required, nothing to do');
			return FALSE;
		}

		// Size
		$this->size = (ee()->TMPL->fetch_param('size')) ?: $this->size;

		// Default Image
		$default = ee()->TMPL->fetch_param('default');
		switch ($default)
		{
			case FALSE:
				$this->default = $this->default;
				break;
			case 'adorable':
				$this->default = $this->adorable_base_url.$this->size.'/'.$this->email;
				break;
			case 'mm':
			case 'identicon':
			case 'monsterid':
			case 'wavatar':
			case 'retro':
			case 'blank':
			default:
				$this->default = $default;
		}

		// Max Rating
		if (in_array(strtolower(ee()->TMPL->fetch_param('rating')), ['g', 'pg', 'r', 'x']))
		{
			$this->rating = ee()->TMPL->fetch_param('rating');
		}

		// Image Extension
		if (in_array(strtolower(ee()->TMPL->fetch_param('extension')), ['jpg', 'jpeg', 'gif', 'png']))
		{
			$this->rating = ee()->TMPL->fetch_param('extension');
		}

		// HTTPS
		if (ee()->TMPL->fetch_param('https'))
		{
			$this->https = get_bool_from_string(ee()->TMPL->fetch_param('https'));
		}

		// Force Default Image
		if (ee()->TMPL->fetch_param('force_default'))
		{
			$this->force_default = get_bool_from_string(ee()->TMPL->fetch_param('force_default'));
		}

		return TRUE;
	}

	// ------------------------------------------------------------------------
}
// END CLASS

// EOF
