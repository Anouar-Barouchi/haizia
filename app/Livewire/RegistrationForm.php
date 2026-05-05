<?php

namespace App\Livewire;

use App\Models\Candidate;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegistrationForm extends Component
{
    use WithFileUploads;

    public $first_name;
    public $last_name;
    public $email;
    public $phone;
    public $birth_date;
    public $address;
    public $membership = 'حر';
    public $membership_name;
    public $profile_pic;
    public $gallery = [];
    public $has_experience = 'لا';
    public $experience_list;
    public $has_awards = 'لا';
    public $awards_list;
    public $terms = false;

    public $successMessage;

    protected $rules = [
        'first_name' => 'required|min:2',
        'last_name' => 'required|min:2',
        'email' => 'required|email|unique:candidates,email',
        'phone' => 'required',
        'birth_date' => 'required|date',
        'address' => 'required',
        'membership' => 'required',
        'profile_pic' => 'required|image|max:2048',
        'gallery' => 'nullable|array|max:3',
        'gallery.*' => 'image|max:2048',
        'terms' => 'accepted',
    ];

    public function submit()
    {
        $this->validate();

        $profilePath = $this->profile_pic->store('profiles', 'public');
        
        $galleryPaths = [];
        foreach ($this->gallery as $photo) {
            $galleryPaths[] = $photo->store('galleries', 'public');
        }

        Candidate::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'birth_date' => $this->birth_date,
            'address' => $this->address,
            'membership' => $this->membership,
            'membership_name' => ($this->membership !== 'حر') ? $this->membership_name : null,
            'profile_pic' => $profilePath,
            'gallery' => $galleryPaths,
            'has_experience' => $this->has_experience === 'نعم',
            'experience_list' => $this->experience_list,
            'has_awards' => $this->has_awards === 'نعم',
            'awards_list' => $this->awards_list,
            'status' => 'pending',
        ]);

        $this->successMessage = 'تم إرسال طلبك بنجاح! سنتواصل معك قريباً.';
        $this->dispatch('candidate-registered');
        $this->reset(['first_name', 'last_name', 'email', 'phone', 'birth_date', 'address', 'membership', 'membership_name', 'profile_pic', 'gallery', 'has_experience', 'experience_list', 'has_awards', 'awards_list', 'terms']);
    }

    public function render()
    {
        return view('livewire.registration-form');
    }
}
