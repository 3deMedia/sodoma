@props(['profile','userType'])
<div>

    <div x-data="{ dashTab: 1 }" class="" x-cloak>
        <ul class="flex flex-wrap">
            <li @click="dashTab = 1" :class="dashTab == 1 ? 'bg-black' : 'bg-white'"
                class="li-dash-tab rounded cursor-pointer flex-grow px-4 py-2 border border-mcolor-400  text-mgray  ">
                {{__('general.Manage_profile')}}</li>
            @if ($userType ==2)

            <li @click="dashTab = 2" :class="dashTab == 2 ? 'bg-black' : 'bg-white'"
                class="li-dash-tab rounded cursor-pointer flex-grow px-4 py-2 border border-mcolor-400  text-mgray ">
                {{__('general.My_escorts')}}</li>
            @endif
            <li @click="dashTab = 3" :class="dashTab == 3 ? 'bg-black' : 'bg-white'"
                class="li-dash-tab rounded cursor-pointer flex-grow px-4 py-2 border border-mcolor-400  text-mgray ">
                {{__('general.Become_vip')}}</li>
            <li @click="dashTab = 4" :class="dashTab == 4 ? 'bg-black' : 'bg-white'"
                class="li-dash-tab rounded cursor-pointer flex-grow px-4 py-2 border border-mcolor-400  text-mgray ">
                {{__('general.Buy_coins')}}</li>
            <li @click="dashTab = 5" :class="dashTab == 5 ? 'bg-black' : 'bg-white'"
                class="li-dash-tab rounded cursor-pointer flex-grow px-4 py-2 border border-mcolor-400 text-mgray ">
                {{__('general.Settings')}}</li>

        </ul>
        <div class="p-4 border border-2 border-mcolor-400">
            <div x-show="dashTab === 1">
                @if($userType==1)
                <x-escort-form :profile="$profile" />
                @elseif ($userType==2)
                <x-agency-profile-form :profile="$profile" />
                @else
                {{__('No profile')}}
                @endif
            </div>


            <div x-show="dashTab === 2">
                @if ($userType ==2 && !is_null($profile))
                <x-agency-escorts-tabpanel :agency="$profile" />
                @else
                {{__('No profile')}}
                @endif
            </div>


            <div x-show="dashTab === 3">
                @if ($profile->is_vip && $userType==1)
                <div class="p-2 bg-pink-400 rounded">
                    <p > {{ __('general.vip.ends_at_message') }} {{ \Carbon\Carbon::parse($profile->VipSubscription->ends_at)->format('d-m-Y')}}</p>
                </div>

                @elseif ($profile->is_vip && $userType==2)
                <div class="p-2 bg-pink-400 rounded">
                <p> {{ __('general.vip.ends_at_message') }} {{ \Carbon\Carbon::parse($profile->Banner->ends_at)->format('d-m-Y') }}</p>
                </div>
                @endif
               <x-become-vip :userType="$userType" />
            </div>

            <div x-show="dashTab === 4">
                <x-premium-ads-form />
            </div>

            <div x-show="dashTab === 5">
                <x-settings-form />
            </div>


        </div>

    </div>
</div>
