<?php

namespace App\Controllers;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\RuanganModel;
use App\Models\AlatModel;
use App\Models\SewaRuanganModel;

class Fasilitas extends BaseController
{
    protected $ruanganModel;
    protected $alatModel;
    protected $sewaRuanganModel;
    protected $helpers = ['form'];

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request,$response,$logger);

        $this->ruanganModel = new RuanganModel();
        $this->alatModel = new AlatModel();
        $this->sewaRuanganModel = new SewaRuanganModel();
        $this->helpers = ['form'];
    }

    public function index()
    {
        // $ruangan = $this->ruanganModel->findAll();
        // $alat = $this->alatModel->findAll();
        // $this->data['ruangan'] = $this->ruanganModel->getRuang();
        // $this->data['alat'] = $this->alatModel->getAlat();
        // $this->data['judul_halaman'] = 'Fasilitas PDIN';
        $this->data = [
            'ruangan' => $this->ruanganModel->getRuangan(),
            'alat' => $this->alatModel->getAlat(),
            'judul_halaman' => 'Fasilitas PDIN'
        ];
        $this->view('fasilitas.php', $this->data);
    }

    public function detailRuangan($slug)
    {
        $ruangan = $this->ruanganModel->getRuangan($slug);
        $jadwal = $this->sewaRuanganModel->getJadwalSewaRuangan($ruangan['id']);

        // tampilan error kalau tidak ada nama ruangan yang ada di database
        if(empty($ruangan))
        {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Ruangan '.$slug.' tidak ditemukan.');
        }
        // menampilkan jadwal sewa ruangan
        if($jadwal) 
        {
            foreach ($jadwal as $key => $value) {
                $this->data['jadwal_sewa'][$key]['title'] = $value['nama_kegiatan'];
                $this->data['jadwal_sewa'][$key]['start'] = $value['tgl_mulai_sewa'];
                $this->data['jadwal_sewa'][$key]['end'] = $value['tgl_akhir_sewa'];
                $this->data['jadwal_sewa'][$key]['backgroundColor'] = "#00a65a";
            }
        }
        else $this->data['jadwal_sewa'] = '';
        
        $this->data['ruangan'] = $this->ruanganModel->getRuangan($slug);
        $this->data['judul_halaman'] = 'Detail Ruangan';

        $this->view('detailruangan.php',$this->data);
    }

    public function detailAlat($slug)
    {
        $alat = $this->alatModel->getAlat($slug);
        $jadwal = $this->alatModel->getJadwalSewaAlat($alat['id']);

        foreach ($jadwal as $key => $value) {
            $this->data['jadwal_sewa'][$key]['title'] = $value['nama_kegiatan'];
            $this->data['jadwal_sewa'][$key]['start'] = $value['tgl_mulai_sewa'];
            $this->data['jadwal_sewa'][$key]['end'] = $value['tgl_akhir_sewa'];
            $this->data['jadwal_sewa'][$key]['backgroundColor'] = "#00a65a";
        }
        
        $this->data['alat'] = $this->alatModel->getAlat($slug);
        $this->data['judul_halaman'] = 'Detail Alat';

        $this->view('detailalat.php',$this->data);
    }

    public function sewaRuangan($id = null)
    {
        session();
        $this->data['id_ruangan'] = $id;
        // $this->data['validation'] = \Config\Services::validation();
        // $this->data['validation'] = $this->validation;
        $this->data['judul_halaman'] = 'Sewa Ruangan PDIN';
        $this->data['ruangan'] = $this->ruanganModel->getRuangan();

        $this->view('sewaruangan.php',$this->data);
    }

    public function sewaAlat($id = null)
    {
        $this->data['id_alat'] = $id;
        $this->data['judul_halaman'] = 'Sewa Alat PDIN';
        $this->data['alat'] = $this->alatModel->getAlat();

        $this->view('sewaalat.php',$this->data);
    }

    public function saveSewaRuangan()
    {
        
        
        $tipe = $this->request->getVar('tipe');
        $idRuangan = $this->request->getVar('ruangan');
        
        // $this->validateFormSewaRuangan($tipe);
        
        // if(!$this->validate([
        //         'nama' => 'required',
        //         'email' => 'required|valid_email'
        //     ])) {
        //             // $validation = \Config\Services::validation();
        //             // dd($validation);
        //             return redirect()->to('/fasilitas/sewaRuangan')->withInput();
        // }

        $date_rules = [];
        if ($tipe == 'Pameran')
        {
            $date_rules = [
                'tanggalMulaiPameran' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => 'tanggal mulai harus diisi',
                        'valid_date' => 'tanggal mulai harus valid'
                    ]
                ],
                'tanggalSelesaiPameran' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => 'tanggal selesai harus diisi',
                        'valid_date' => 'tanggal selesai harus valid'
                    ]
                ]
            ];
        } elseif ($tipe == 'Kantor')
        {
            $date_rules = [
                'tanggalMulaiKantor' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => 'tanggal mulai harus diisi',
                        'valid_date' => 'tanggal mulai harus valid'
                    ]
                ],
                'tanggalSelesaiKantor' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => 'tanggal selesai harus diisi',
                        'valid_date' => 'tanggal selesai harus valid'
                    ]
                ]
            ];
        } elseif ($tipe == 'Meeting')
        {
            $date_rules = [
                'tanggalMulaiMeeting' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => 'tanggal mulai harus diisi',
                        'valid_date' => 'tanggal mulai harus valid'
                    ]
                ],
                'tanggalSelesaiMeeting' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => 'tanggal selesai harus diisi',
                        'valid_date' => 'tanggal selesai harus valid'
                    ]
                ]
            ];
        }

        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => '{field} harus valid'
                ]
            ],
            'nomorTelepon' => [
                'rules' => 'required|numeric|min_length[8]|max_length[15]',
                'errors' => [
                    'required' => 'nomor telepon harus diisi',
                    'numeric' => 'nomor telepon harus berupa angka',
                    'min_length' => 'nomor telepon harus lebih dari 8 angka',
                    'max_length' => 'nomor telepon harus kurang dari 15 angka'
                ]
            ],
            'instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'namaKegiatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama kegiatan harus diisi'
                ]
            ],
            'deskripsiKegiatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'deskripsi kegiatan harus diisi'
                ]
            ],
            'ruangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus dipilih'
                ]
            ],
        ];

        $rules = $this->formRulesSewaRuangan($tipe);

        // if(!$this->validate(array_merge($rules,$date_rules)))
        if(!$this->validate(array_merge($rules)))
        {
            // $validation = \Config\Services::validation();            
            // return redirect()->to('/fasilitas/sewaRuangan')->withInput()->with('validation',$validation);
            return redirect()->to('/fasilitas/sewaRuangan')->withInput();
        }
        
        dd($this->request->getVar());

        if($tipe == 'Pameran')
        {
            $this->sewaRuanganModel->save([
                'id_ruangan' => $idRuangan,
                'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
                'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
                'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiPameran'),
                'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiPameran'),    
            ]);
        } elseif($tipe == 'Kantor')
        {
            $this->sewaRuanganModel->save([
                'id_ruangan' => $idRuangan,
                'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
                'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
                'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiKantor'),
                'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiKantor'),    
            ]);
        } elseif($tipe == 'Meeting')
        {
            $this->sewaRuanganModel->save([
                'id_ruangan' => $idRuangan,
                'nama_kegiatan' => $this->request->getVar('namaKegiatan'),
                'deskripsi' => $this->request->getVar('deskripsiKegiatan'),
                'tgl_mulai_sewa' => $this->request->getVar('tanggalMulaiMeeting'),
                'tgl_akhir_sewa' => $this->request->getVar('tanggalSelesaiMeeting'),    
            ]);
        }
        $ruangan = $this->ruanganModel->getRuanganByID($idRuangan);
        $namaRuangan = $ruangan['slug'];

        session()->setFlashdata('sukses','Data berhasil ditambahkan.');
        
        return redirect()->to("/fasilitas/ruang/".$namaRuangan);
    }

    // validasi form sewa ruangan 
    public function formRulesSewaRuangan($tipe)
    {
        helper('form');
        $date_rules = [];
        if ($tipe == 'Pameran')
        {
            $date_rules = [
                'tanggalMulaiPameran' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => 'tanggal mulai harus diisi',
                        'valid_date' => 'tanggal mulai harus valid'
                    ]
                ],
                'tanggalSelesaiPameran' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => 'tanggal selesai harus diisi',
                        'valid_date' => 'tanggal selesai harus valid'
                    ]
                ]
            ];
        } elseif ($tipe == 'Kantor')
        {
            $date_rules = [
                'tanggalMulaiKantor' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => 'tanggal mulai harus diisi',
                        'valid_date' => 'tanggal mulai harus valid'
                    ]
                ],
                'tanggalSelesaiKantor' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => 'tanggal selesai harus diisi',
                        'valid_date' => 'tanggal selesai harus valid'
                    ]
                ]
            ];
        } elseif ($tipe == 'Meeting')
        {
            $date_rules = [
                'tanggalMulaiMeeting' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => 'tanggal mulai harus diisi',
                        'valid_date' => 'tanggal mulai harus valid'
                    ]
                ],
                'tanggalSelesaiMeeting' => [
                    'rules' => 'required|valid_date',
                    'errors' => [
                        'required' => 'tanggal selesai harus diisi',
                        'valid_date' => 'tanggal selesai harus valid'
                    ]
                ]
            ];
        }

        $rules = [
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => '{field} harus diisi',
                    'valid_email' => '{field} harus valid'
                ]
            ],
            'nomorTelepon' => [
                'rules' => 'required|numeric|min_length[8]|max_length[15]',
                'errors' => [
                    'required' => 'nomor telepon harus diisi',
                    'numeric' => 'nomor telepon harus berupa angka',
                    'min_length' => 'nomor telepon harus lebih dari 8 angka',
                    'max_length' => 'nomor telepon harus kurang dari 15 angka'
                ]
            ],
            'instansi' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'namaKegiatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'nama kegiatan harus diisi'
                ]
            ],
            'deskripsiKegiatan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'deskripsi kegiatan harus diisi'
                ]
            ],
            'ruangan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus dipilih'
                ]
            ],
        ];

        return array_merge($rules,$date_rules);

        // dd($rules);

        // if(!$this->validate(array_merge($rules,$date_rules)))
        // {
        //     $validation = \Config\Services::validation();            
        //     // return redirect()->to('/fasilitas/sewaRuangan')->withInput()->with('validation',$validation);

        //     dd($validation);
        //     return redirect()->to('/fasilitas/sewaRuangan')->withInput();
            
        // }
        // else echo '';
    }
}
