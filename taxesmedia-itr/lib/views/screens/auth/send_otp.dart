import 'package:flutter/material.dart';
import 'package:flutter_gen/gen_l10n/app_localizations.dart';
import 'package:flutter_hooks/flutter_hooks.dart';
import 'package:hooks_riverpod/hooks_riverpod.dart';
import 'package:itr/core/controllers/auth.dart';
import 'package:itr/routes.dart';
import 'package:itr/views/widgets/primary_button.dart';
import 'package:itr/views/widgets/transparent_app_bar.dart';

class SendOTPScreen extends HookConsumerWidget {
  const SendOTPScreen({Key? key}) : super(key: key);

  @override
  Widget build(BuildContext context, WidgetRef ref) {
    final formKey = useMemoized(() => GlobalKey<FormState>());
    final phoneController = useTextEditingController();

    return Container(
      decoration: const BoxDecoration(
        image: DecorationImage(
          image: AssetImage('assets/images/bg-gradient.jpg'),
          fit: BoxFit.cover,
        ),
      ),
      child: Scaffold(
        backgroundColor: Colors.transparent,
        appBar: const TransparentAppBar(),
        body: SafeArea(
          child: Padding(
            padding: const EdgeInsets.all(16.0),
            child: Form(
              key: formKey,
              child: ListView(
                children: [
                  Text(
                    AppLocalizations.of(context)!.enter_mobile_number,
                    style: Theme.of(context).textTheme.headline3,
                  ),
                  const SizedBox(height: 12),
                  Text(
                    AppLocalizations.of(context)!.we_will_send_code,
                    style: Theme.of(context).textTheme.subtitle2,
                  ),
                  const SizedBox(height: 40),
                  TextFormField(
                    controller: phoneController,
                    autofocus: true,
                    keyboardType: TextInputType.number,
                    decoration: const InputDecoration(
                      prefix: Padding(
                        padding: EdgeInsets.only(right: 3),
                        child: Text('+88'),
                      ),
                    ),
                    validator: (value) {
                      if (value?.trim().isEmpty ?? true) {
                        return 'This field is required';
                      }
                      if (value!.trim().length != 11 ||
                          !value.trim().startsWith('01')) {
                        return 'Invalid number';
                      }
                      try {
                        int.parse(value.trim());
                      } catch (e) {
                        return 'Invalid value';
                      }
                      return null;
                    },
                  ),
                  const SizedBox(height: 20),
                  PrimaryButton(
                    onTap: () {
                      if (!(formKey.currentState?.validate() ?? false)) {
                        return null;
                      }
                      ref.read(authControllerProvider).sendOTP(
                            '+88${phoneController.text.trim()}',
                          );
                      return Navigator.pushNamed(
                        context,
                        Routes.verifyOtp,
                        arguments: '+88${phoneController.text.trim()}',
                      );
                    },
                    text: AppLocalizations.of(context)!.next,
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }
}
