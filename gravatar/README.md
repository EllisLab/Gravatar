# Gravatar

Outputs a Globally Recognized Avatar ([Gravatar](http://gravatar.com)), with a plethora of customization options, including [Adorable Avatars](http://avatars.adorable.io).

## Requirements

- ExpressionEngine 3
- PHP 5.4+
- Uses [Gravatar lib from @forxer](https://github.com/forxer/gravatar), included.

## Installation

1. Download the [latest release](https://github.com/EllisLab/Gravatar/releases/latest).
2. Copy the `gravatar` folder to your `system/user/addons` folder (you can ignore the rest of this repository's files).
3. In your ExpressionEngine control panel, visit the Add-On Manager and click Install next to "Gravatar".

## Usage

### `{exp:gravatar}`

#### Example Usage

The Gravatar is a single tag plugin that is most commonly used in an `img` tag:

```
<img src="{exp:gravatar email='username@example.com'}" alt="username's avatar">
```

#### Parameters

##### email= (*required*)

Email address for the gravatar user. This will typically come from a variable, e.g.:

```
{exp:gravatar email='{email}'}
```

##### size=

The size of the resulting image, in pixels.

##### default=

The default image to use as a fallback when the provided email address has no Gravatar profile. Valid options are:

- `adorable` - an adorable avatar unique for the email identifier from [Adorable Avatars](http://avatars.adorable.io)
- `blank` - a transparent PNG image (border added to HTML below for demonstration purposes)
- `identicon` - a geometric pattern based on an email hash
- `mm` (default) - (mystery-man) a simple, cartoon-style silhouetted outline of a person (does not vary by email hash)
- `monsterid` - a generated 'monster' with different colors, faces, etc
- `retro` -  awesome generated, 8-bit arcade-style pixelated faces
- `wavatar` - generated faces with differing features and backgrounds
- URL, e.g.: `https://example.com/avatar.png` - any full URL to a publicly available image

Note: Gravatar's `404` response default image type is not supported.

##### rating=

The maximum self-rated threshold for image content. Valid options are:

- `g` - suitable for display on all websites with any audience type.
- `pg` (default) - may contain rude gestures, provocatively dressed individuals, the lesser swear words, or mild violence.
- `r` - may contain such things as harsh profanity, intense violence, nudity, or hard drug use.
- `x` - may contain hardcore sexual imagery or extremely disturbing violence.

##### extension=

The desired image type, by file extension. Valid options are:

- `gif`
- `jpeg`
- `jpg`
- `png` (default)

##### https=

Whether or not the image should be served securely. If an unsecure request is made from a secure (SSL) page, the browser will issue security warnings. You should be able to leave this setting at its default value, because you're already using SSL everywhere, right? Right??

- `yes` (default) - URL will use `https://`
- `no` - URL will use `http://`

##### force_default=

Whether or not you'd like to force the use of default avatar images instead of using images from Gravatar profiles. This is useful during development with mock data, or for sites that want public avatars to all have the same look and feel, either by using one of Gravatar's default generators, the Adorable Avatar generator, or any similar service.

- `yes` - Returned image will always return your default image preference
- `no` (default) - Returned image will be the user's Gravatar profile image, or the default image if one is not available

Example: all monsters, all the time:

```
{exp:gravatar email='{email}' default='monsterid' force_default='yes'}
```

## Change Log

### 1.0.2

- Updated [forxer/Gravatar lib](https://github.com/forxer/gravatar) to v1.3.1, allowing removal of a workaround for a bug in said library.

### 1.0.1

- adjusting build dependencies, no functional changes

### 1.0.0

- Initial release. Boom!

## Additional Files

You may be wondering what the rest of the files in this package are for. They are solely for development, so if you are forking the GitHub repo, they can be helpful. If you are just using the add-on in your ExpressionEngine installation, you can ignore all of these files.

- **.editorconfig**: [EditorConfig](http://editorconfig.org) helps developers maintain consistent coding styles across files and text editors.
- **.gitignore:** [.gitignore](https://git-scm.com/docs/gitignore) lets you specify files in your working environment that you do not want under source control.
- **.travis.yml:** A [Travis CI](https://travis-ci.org) configuration file for continuous integration (automated testing, releases, etc.).
- **.composer.json:** A [Composer project setup file](https://getcomposer.org/doc/01-basic-usage.md) that manages development dependencies.
- **.composer.lock:** A [list of dependency versions](https://getcomposer.org/doc/01-basic-usage.md#composer-lock-the-lock-file) that Composer has locked to this project.

## License

Copyright (C) 2016 EllisLab, Inc.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL ELLISLAB, INC. BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

Except as contained in this notice, the name of EllisLab, Inc. shall not be used in advertising or otherwise to promote the sale, use or other dealings in this Software without prior written authorization from EllisLab, Inc.
