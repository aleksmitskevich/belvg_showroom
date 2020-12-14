<?php

namespace BelVG\Showroom\Setup;

use BelVG\Showroom\Model\ShowroomFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /**
     * @var ShowroomFactory
     */
    protected $showroomFactory;

    /**
     * InstallData constructor.
     * @param ShowroomFactory $showroomFactory
     */
    public function __construct(
        ShowroomFactory $showroomFactory
    ) {
        $this->showroomFactory = $showroomFactory;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Exception
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $showrooms = [
            ['showroom_name' => "Test Showroom 1"],
            ['showroom_name' => "Test Showroom 2"],
            ['showroom_name' => "Test Showroom 3"],
            ['showroom_name' => "Test Showroom 4"],
            ['showroom_name' => "Test Showroom 5"]
        ];
        foreach ($showrooms as $data) {
            $showroom = $this->showroomFactory->create();
            $showroom->addData($data)->save();
        }
    }
}
