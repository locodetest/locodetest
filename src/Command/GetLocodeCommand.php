<?php
namespace App\Command;

use App\Services\Filer;
use App\Services\LocodeService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetLocodeCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:updatelocode';

    private $filer;
    /**
     * @var LocodeService
     */
    private $locode;

    /**
     * GetLocodeCommand constructor.
     */
    public function __construct(Filer $filer, LocodeService $locode){
        $this->filer = $filer;
        $this->locode = $locode;

        parent::__construct();
    }

    protected function configure()
    {
        // ...
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('[' . date('H:i:s') . "]: getting LOCODE update...");
        $this->filer->getRemote();

        $output->writeln('[' . date('H:i:s') . "]: unpacking LOCODE update...");
        $this->filer->extractZip();

        $output->writeln('[' . date('H:i:s') . "]: clearing DB...");
        $this->locode->clearDb();

        $output->writeln('[' . date('H:i:s') . "]: importing CSVs...");
        $csvs = $this->filer->getCsvList();

        foreach ($csvs as $csv) {
            $output->writeln('[' . date('H:i:s') . "]: $csv... ");
            $this->locode->parseCsv($csv);
            $output->writeln("done!");
        }

        $output->writeln("Update complete\n");

        return 0;
    }
}