<?php

namespace Kunstmaan\MediaBundle\Tests\Helper\RemoteVideo;

use Kunstmaan\MediaBundle\Entity\Media;
use Kunstmaan\MediaBundle\Helper\RemoteVideo\RemoteVideoHandler;
use Kunstmaan\MediaBundle\Helper\RemoteVideo\RemoteVideoHelper;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-09-28 at 14:19:22.
 */
class RemoteVideoHelperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Media
     */
    protected $media;

    /**
     * @var RemoteVideoHelper
     */
    protected $object;

    protected function setUp()
    {
        $this->media = new Media();
        $this->object = new RemoteVideoHelper($this->media);
    }

    public function testGetMedia()
    {
        $this->assertEquals(RemoteVideoHandler::CONTENT_TYPE, $this->object->getMedia()->getContentType());
    }
}
