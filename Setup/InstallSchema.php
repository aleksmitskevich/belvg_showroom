<?php

namespace BelVG\Showroom\Setup;

use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Psr\Log\LoggerInterface;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * InstallSchema constructor.
     * @param LoggerInterface $logger
     */
    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('belvg_booking_showroom')) {
            try {
                $tableBookingShowroom = $installer->getConnection()->newTable(
                    $installer->getTable('belvg_booking_showroom')
                )
                    ->addColumn(
                        'booking_id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary' => true,
                            'unsigned' => true,
                        ],
                        'Booking ID'
                    )
                    ->addColumn(
                        'customer_name',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Customer Name'
                    )
                    ->addColumn(
                        'customer_email',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Customer Email'
                    )
                    ->addColumn(
                        'booking_date',
                        Table::TYPE_TIMESTAMP,
                        null,
                        ['nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE],
                        'Booking Date'
                    )
                    ->addColumn(
                        'showroom_name',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Showroom Name'
                    )
                    ->setComment('Booking Showroom Table');
                $installer->getConnection()->createTable($tableBookingShowroom);
            } catch (\Zend_Db_Exception $e) {
                $this->logger->error($e->getMessage());
            }

            $installer->getConnection()->addIndex(
                $installer->getTable('belvg_booking_showroom'),
                $setup->getIdxName(
                    $installer->getTable('belvg_booking_showroom'),
                    ['customer_name', 'showroom_name', 'customer_email'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['customer_name', 'showroom_name', 'customer_email'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        if (!$installer->tableExists('belvg_showroom')) {
            try {
                $tableShowroom = $installer->getConnection()->newTable(
                    $installer->getTable('belvg_showroom')
                )
                    ->addColumn(
                        'showroom_id',
                        Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary' => true,
                            'unsigned' => true,
                        ],
                        'Showroom ID'
                    )
                    ->addColumn(
                        'showroom_name',
                        Table::TYPE_TEXT,
                        255,
                        ['nullable => false'],
                        'Showroom Name'
                    )
                    ->setComment('Showroom Table');
                $installer->getConnection()->createTable($tableShowroom);
            } catch (\Zend_Db_Exception $e) {
                $this->logger->error($e->getMessage());
            }

            $installer->getConnection()->addIndex(
                $installer->getTable('belvg_showroom'),
                $setup->getIdxName(
                    $installer->getTable('belvg_showroom'),
                    ['showroom_name'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['showroom_name'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }
        $installer->endSetup();
    }
}
