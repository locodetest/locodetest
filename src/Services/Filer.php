<?php
namespace App\Services;

use App\DTO\UserdataDTO;
use App\Types\FunctionType;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Locode;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class Filer
{
    protected $filename;
    protected $folder;
    protected $remoteLocodePath;

    protected $filesystem;
    protected $csvParser;

    public function __construct(ContainerBagInterface $params, Filesystem $filesystem, CsvParser $csvParser)
    {
        $this->filesystem = $filesystem;
        $this->csvParser = $csvParser;

        $this->folder = $params->get('app.storage_work_path');
        $this->filename = $params->get('app.storage_local_locode_filename');
        $this->remoteLocodePath = $params->get('app.remote_locode_path');
    }

    public function getRemote()
    {
        $this->filesystem->copy($this->remoteLocodePath, $this->getFilePath(), true);
    }

    public function extractZip()
    {
        $filename = $this->getFilePath();
        $zip = new \ZipArchive();
        $zip->open($filename);
        $zip->extractTo($this->folder);
        $zip->close();
    }

    public function getCsvList()
    {
        $finder = new Finder();
        $finder->files()->name('*UNLOCODE*.csv')->in($this->folder);

        $list = [];
        foreach ($finder as $file) {
            $list[] = $file->getRealPath();
        }

        return $list;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;
    }

    public function setFolder($folder)
    {
        $this->folder = $folder;
    }

    public function getFilePath(): string
    {
        return $this->folder . $this->filename;
    }
}