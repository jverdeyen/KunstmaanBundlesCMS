<?php

namespace Kunstmaan\AdminListBundle\Tests\AdminList\FilterType\ORM;

use Codeception\Test\Unit;
use Kunstmaan\AdminListBundle\AdminList\FilterType\ORM\NumberFilterType;
use Symfony\Component\HttpFoundation\Request;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2012-09-26 at 13:21:34.
 */
class NumberFilterTypeTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    /**
     * @var NumberFilterType
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function _before()
    {
        $this->object = new NumberFilterType('number', 'b');
    }

    public function testBindRequest()
    {
        $request = new Request(array('filter_comparator_number' => 'eq', 'filter_value_number' => 10));

        $data = array();
        $uniqueId = 'number';
        $this->object->bindRequest($request, $data, $uniqueId);

        $this->assertEquals(array('comparator' => 'eq', 'value' => 10), $data);
    }

    /**
     * @param string $comparator  The comparator
     * @param string $whereClause The where clause
     * @param mixed  $value       The value
     * @param mixed  $testValue   The test value
     *
     * @dataProvider applyDataProvider
     */
    public function testApply($comparator, $whereClause, $value, $testValue)
    {
        $qb = $this->tester->getORMQueryBuilder();
        $qb->select('b')
            ->from('Entity', 'b');
        $this->object->setQueryBuilder($qb);
        $this->object->apply(array('comparator' => $comparator, 'value' => $value), 'number');

        $this->assertEquals("SELECT b FROM Entity b WHERE b.number $whereClause", $qb->getDQL());
        if ($testValue) {
            $this->assertEquals($value, $qb->getParameter('var_number')->getValue());
        }
    }

    /**
     * @return array
     */
    public static function applyDataProvider()
    {
        return array(
            array('eq', '= :var_number', 1, true),
            array('neq', '<> :var_number', 2, true),
            array('lt', '< :var_number', 3, true),
            array('lte', '<= :var_number', 4, true),
            array('gt', '> :var_number', 5, true),
            array('gte', '>= :var_number', 6, true),
            array('isnull', 'IS NULL', 0, false),
            array('isnotnull', 'IS NOT NULL', 0, false),
        );
    }

    public function testGetTemplate()
    {
        $this->assertEquals('KunstmaanAdminListBundle:FilterType:numberFilter.html.twig', $this->object->getTemplate());
    }
}