<?php
namespace Simplicity\Library\Http\Response;
/**
 * @see https://github.com/symfony/HttpFoundation/blob/master/Response.php
 */
class Output
{
    use Output\Common;
    use Output\Status;
    use Output\Contents;
    use Output\Cache;
    use Output\Date;
    use Output\MimeType;
    use Output\Charset;
    /**
     * @var \Illuminate\Http\Request
     */
    static $response = false;
}
