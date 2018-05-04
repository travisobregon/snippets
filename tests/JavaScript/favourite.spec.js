import { mount } from 'vue-test-utils';
import expect from 'expect';
import axios from 'axios';
import moxios from 'moxios';
import Favourite from '../../resources/assets/js/components/Favourite.vue';
import Vue from "vue";

describe('Favourite', () => {
    beforeEach(() => {
        moxios.install(axios);
    });

    afterEach(() => {
        moxios.uninstall(axios);
    });

    it('shows a heart icon', () => {
        const wrapper = mount(Favourite);

        expect(wrapper.contains('button.glyphicon.glyphicon-heart')).toBe(true);
    });

    it('accepts count and favourited props', () => {
        const wrapper = mount(Favourite, {
            propsData: {
                initialCount: '5',
                initialFavourited: true
            }
        });

        expect(wrapper.vm.count).toBe('5');
        expect(wrapper.vm.favourited).toBe(true);

        expect(wrapper.find('span').text()).toBe('5');
        expect(wrapper.find('button').classes()).toContain('favourited');
    });
});