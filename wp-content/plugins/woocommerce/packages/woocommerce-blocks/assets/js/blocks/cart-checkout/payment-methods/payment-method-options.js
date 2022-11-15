/**
 * External dependencies
 */
import {
	usePaymentMethods,
	usePaymentMethodInterface,
	useEmitResponse,
	useStoreNotices,
} from '@woocommerce/base-context/hooks';
import { cloneElement } from '@wordpress/element';
import {
	useEditorContext,
	usePaymentMethodDataContext,
} from '@woocommerce/base-context';
import classNames from 'classnames';
import RadioControlAccordion from '@woocommerce/base-components/radio-control-accordion';

/**
 * Internal dependencies
 */
import PaymentMethodCard from './payment-method-card';

/**
 * Component used to render all non-saved payment method options.
 *
 * @return {*} The rendered component.
 */
const PaymentMethodOptions = () => {
	const {
		setActivePaymentMethod,
		activeSavedToken,
		setActiveSavedToken,
		expressPaymentMethods,
		customerPaymentMethods,
	} = usePaymentMethodDataContext();
	const { paymentMethods } = usePaymentMethods();
	const {
		activePaymentMethod,
		...paymentMethodInterface
	} = usePaymentMethodInterface();
	const expressPaymentMethodActive = Object.keys(
		expressPaymentMethods
	).includes( activePaymentMethod );
	const { noticeContexts } = useEmitResponse();
	const { removeNotice } = useStoreNotices();
	const { isEditor } = useEditorContext();

	const options = Object.keys( paymentMethods ).map( ( name ) => {
		const { edit, content, label, supports } = paymentMethods[ name ];
		const component = isEditor ? edit : content;
		return {
			value: name,
			label:
				typeof label === 'string'
					? label
					: cloneElement( label, {
							components: paymentMethodInterface.components,
					  } ),
			name: `wc-saved-payment-method-token-${ name }`,
			content: (
				<PaymentMethodCard showSaveOption={ supports.showSaveOption }>
					{ cloneElement( component, {
						activePaymentMethod,
						...paymentMethodInterface,
					} ) }
				</PaymentMethodCard>
			),
		};
	} );

	const updateToken = ( value ) => {
		setActivePaymentMethod( value );
		setActiveSavedToken( '' );
		removeNotice( 'wc-payment-error', noticeContexts.PAYMENTS );
	};

	const isSinglePaymentMethod =
		Object.keys( customerPaymentMethods ).length === 0 &&
		Object.keys( paymentMethods ).length === 1;

	const singleOptionClass = classNames( {
		'disable-radio-control': isSinglePaymentMethod,
	} );

	return expressPaymentMethodActive ? null : (
		<RadioControlAccordion
			id={ 'wc-payment-method-options' }
			className={ singleOptionClass }
			selected={ activeSavedToken ? null : activePaymentMethod }
			onChange={ updateToken }
			options={ options }
		/>
	);
};

export default PaymentMethodOptions;
